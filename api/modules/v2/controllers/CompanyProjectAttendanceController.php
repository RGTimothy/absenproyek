<?php

namespace api\modules\v2\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v2\models\CompanyProjectAttendance;
use api\modules\v2\models\CompanyProjectAttendanceSummary;
use api\modules\v2\models\CompanyClock;

class CompanyProjectAttendanceController extends ActiveController
{
	const TIME_ONE_DAY = 86400;
	const IMAGE_FOLDER = 'attendance_images';

	const CLOCK_IN = 'CLOCK_IN',
		  CLOCK_OUT = 'CLOCK_OUT';

	public $modelClass = 'api\modules\v2\models\CompanyProjectAttendance';

	public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpHeaderAuth::className(),
            ],
        ];
        return $behaviors;
    }

	public function actionStatus($companyProjectID = null) {
		$userID = Yii::$app->user->id;
		$headers = Yii::$app->request->headers;
		$companyID = Yii::$app->user->identity->company_id;

		//set user's timezone
		$timezone =  $headers->get('timezone');
		if (is_null($timezone)) {
			$timezone = 'Asia/Jakarta';
		}

		date_default_timezone_set($timezone);

		//get range of all company clocks in 1 cycle
		$mainWorkingTime = CompanyClock::find()->andWhere([
							'company_id' => $companyID,
							'is_default' => CompanyClock::DEFAULT_WORKING_TIME
						])
						->select(['UNIX_TIMESTAMP(DATE_SUB(clock_in, INTERVAL 1 HOUR)) AS clock_in'])
						->one();

		$cycleStartTime = isset($mainWorkingTime->clock_in) ? intval($mainWorkingTime->clock_in) : 0;

		$unixTimestampOneDay = self::TIME_ONE_DAY;
		$attendances = CompanyProjectAttendance::findByUserId($userID)
						// ->andWhere(['DATE(created_at)' => $currentDate])
						->andWhere(
							'
								CASE WHEN UNIX_TIMESTAMP(CURRENT_TIME()) >= '.$cycleStartTime.'
									THEN UNIX_TIMESTAMP(created_at) >= '.$cycleStartTime.' AND UNIX_TIMESTAMP(created_at) < UNIX_TIMESTAMP(created_at) + '.$unixTimestampOneDay.'
								ELSE UNIX_TIMESTAMP(created_at) < '.$cycleStartTime.' AND UNIX_TIMESTAMP(created_at) > UNIX_TIMESTAMP(created_at) - '.$unixTimestampOneDay.'
								END
							'
						)
						->orderBy(['id' => SORT_ASC])
						->all();

		$todayAttendanceHistory = array();
		$currentProjectAttendance = array();
		$clockInStatus = false;
		$clockOutStatus = false;
		$lastState = null;
		$lastProjectID = null;
		foreach ($attendances as $item) {
			$arrItem = [
				'companyProjectAttendanceID' => $item->id,
				'companyProjectAttendanceUserID' => $item->user_id,
				'companyProjectAttendanceProjectID' => $item->company_project_id,
				'companyProjectAttendanceProjectName' => $item->companyProject->name,
				'companyProjectAttendanceLatitude' => $item->latitude,
				'companyProjectAttendanceLongitude' => $item->longitude,
				'companyProjectAttendanceStatus' => $item->status,
				'companyProjectAttendanceTime' => $item->created_at,
				'companyProjectAttendanceUnixTime' => strtotime($item->created_at)
			];

			if ($item->company_project_id == $companyProjectID) {
				array_push($currentProjectAttendance, $arrItem);
			}

			if ($item->status == self::CLOCK_IN) {
				array_push($todayAttendanceHistory, $arrItem);
				$lastState = self::CLOCK_IN;
				$lastProjectID = $item->company_project_id;
			}

			if ($item->status == self::CLOCK_OUT) {
				array_push($todayAttendanceHistory, $arrItem);
				$lastState = self::CLOCK_OUT;
				$lastProjectID = $item->company_project_id;
			}
		}

		//set clock in & clock out status based on current state
		if (!is_null($lastState)) {
			if ($lastState == self::CLOCK_OUT) {
				$clockInStatus = false;
				$clockOutStatus = false;
			} else {
				$clockInStatus = true;
				$clockOutStatus = false;
			}
		}

		$response['hasErrors'] = false;
		$response['clockInStatus'] = $clockInStatus;
		$response['clockOutStatus'] = $clockOutStatus;
		$response['lastState'] = $lastState;
		$response['lastProjectID'] = $lastProjectID;
		$response['data'] = $todayAttendanceHistory;
		$response['currentProjectAttendance'] = $currentProjectAttendance;
		$response['cycleStartTime'] = $cycleStartTime;

		// return self::calculateWorkingHours($currentProjectAttendance);
		// return self::updateCompanyProjectAttendanceSummary($currentProjectAttendance, $timezone, 1);
		return $response;
	}

	public function actionClockIn() {
		//get request params
		$userID = Yii::$app->user->id;
		$params = Yii::$app->request->post();
		$companyProjectID = $params['companyProjectID'];
		$latitude = $params['latitude'];
		$longitude = $params['longitude'];
		$image = $params['image'];

		//get current attendance status
		$attendance = self::actionStatus($companyProjectID);

		if ($attendance['lastState'] == self::CLOCK_IN) {
			$response['hasErrors'] = true;
			$response['message'] = 'Fail. You have been clocked in before.';
		} else {
			//do clock in
			$model = new CompanyProjectAttendance();
			$model->user_id = $userID;
			$model->company_project_id = $companyProjectID;
			$model->latitude = $latitude;
			$model->longitude = $longitude;

			$explodeImageString = explode(',', $image, 2); // limit to 2 parts, i.e: find the first comma
            $explodeFirstline = explode(';', $explodeImageString[0], 2)[0];
            $fileExtension = explode('/', $explodeFirstline, 2)[1];
            $encodedImage = $explodeImageString[1]; // pick up the 2nd part

            //save large image raw without resizing
            $decodedImage = base64_decode($encodedImage);

            //generate image filename
            $filename = 'attendance' . '_' . $userID . '_' . time();

            $model->image = $decodedImage;
            $model->image_filename = $filename;
            $model->image_filetype = $fileExtension;
			$model->status = self::CLOCK_IN;

			if ($model->save()) {
				//upload image file
				$uploadPath = Yii::getAlias('@backend') . '/web/uploads/' . self::IMAGE_FOLDER;
				if (!file_exists($uploadPath)) {
				    mkdir($uploadPath, 0755, true);
				}
				file_put_contents($uploadPath . '/' . $filename . '.' . $fileExtension, $decodedImage);

				$response['hasErrors'] = $model->hasErrors();
				$response['message'] = 'Clock in success!';
				$response['data'] = [];

				$headers = Yii::$app->request->headers;

				//set user's timezone
				$timezone =  $headers->get('timezone');
				if (is_null($timezone)) {
					$timezone = 'Asia/Jakarta';
				}

				//get current date
				$now = new \DateTime("now", new \DateTimeZone($timezone) );
				$currentDate = $now->format('Y-m-d');

				$companyProjectAttendance = CompanyProjectAttendance::findByUserId($userID)
											->andWhere([
												'DATE(created_at)' => $currentDate,
												'status' => self::CLOCK_IN
											])
											->orderBy(['id' => SORT_DESC])
											->one();

				if (!is_null($companyProjectAttendance)) {
					$response['data'] = [
						'companyProjectAttendanceID' => $companyProjectAttendance->id,
						'companyProjectAttendanceUserID' => $companyProjectAttendance->user_id,
						'companyProjectAttendanceProjectID' => $companyProjectAttendance->company_project_id,
						'companyProjectAttendanceProjectName' => $companyProjectAttendance->companyProject->name,
						'companyProjectAttendanceLatitude' => $companyProjectAttendance->latitude,
						'companyProjectAttendanceLongitude' => $companyProjectAttendance->longitude,
						'companyProjectAttendanceStatus' => $companyProjectAttendance->status,
						'companyProjectAttendanceTime' => $companyProjectAttendance->created_at,
					];

					//push current attendance to attendance array list
					array_push($attendance['currentProjectAttendance'], $response['data']);

					$updateCompanyProjectAttendanceSummary = self::updateCompanyProjectAttendanceSummary($attendance['currentProjectAttendance'], $timezone, $companyProjectID, $attendance['cycleStartTime']);
				}
			} else {
				$errors = $model->getErrors();
	            $response['hasErrors'] = $model->hasErrors();

	            $errorList = array();
	            foreach ($errors as $key => $value) {
	                array_push($errorList, [
	                    'errorField' => $key,
	                    'errorMessage' => $value[0]
	                ]);
	            }

	            $response['message'] = $errorList[0]['errorMessage'];
			}
		}

		return $response;
	}

	public function actionClockOut() {
		//get request params
		$userID = Yii::$app->user->id;
		$params = Yii::$app->request->post();
		$companyProjectID = $params['companyProjectID'];
		$latitude = $params['latitude'];
		$longitude = $params['longitude'];
		$image = $params['image'];

		//get current attendance status
		$attendance = self::actionStatus($companyProjectID);

		if ($attendance['lastState'] == self::CLOCK_OUT) {
			$response['hasErrors'] = true;
			$response['message'] = 'Fail. You have been clocked out before.';
		} else if (is_null($attendance['lastState'])) {
			$response['hasErrors'] = true;
			$response['message'] = 'Fail. You have to clock in first before doing clock out.';
		} else {
			if (!is_null($attendance['lastProjectID'])) {
				if ($attendance['lastProjectID'] != $companyProjectID) {
					$response['hasErrors'] = true;
					$response['message'] = 'Gagal absen. Anda harus clock out di proyek yang lain terlebih dahulu.';
				} else {
					//do clock out
					$model = new CompanyProjectAttendance();
					$model->user_id = $userID;
					$model->company_project_id = $companyProjectID;
					$model->latitude = $latitude;
					$model->longitude = $longitude;

					$explodeImageString = explode(',', $image, 2); // limit to 2 parts, i.e: find the first comma
		            $explodeFirstline = explode(';', $explodeImageString[0], 2)[0];
		            $fileExtension = explode('/', $explodeFirstline, 2)[1];
		            $encodedImage = $explodeImageString[1]; // pick up the 2nd part

		            //save large image raw without resizing
		            $decodedImage = base64_decode($encodedImage);

		            //generate image filename
		            $filename = 'attendance' . '_' . $userID . '_' . time();

		            $model->image = $decodedImage;
		            $model->image_filename = $filename;
		            $model->image_filetype = $fileExtension;
					$model->status = self::CLOCK_OUT;

					if ($model->save()) {
						//upload image file
						$uploadPath = Yii::getAlias('@backend') . '/web/uploads/' . self::IMAGE_FOLDER;
						if (!file_exists($uploadPath)) {
						    mkdir($uploadPath, 0755, true);
						}
						file_put_contents($uploadPath . '/' . $filename . '.' . $fileExtension, $decodedImage);

						$response['hasErrors'] = $model->hasErrors();
						$response['message'] = 'Clock out success!';
						$response['data'] = [];

						$headers = Yii::$app->request->headers;

						//set user's timezone
						$timezone =  $headers->get('timezone');
						if (is_null($timezone)) {
							$timezone = 'Asia/Jakarta';
						}

						//get current date
						$now = new \DateTime("now", new \DateTimeZone($timezone) );
						$currentDate = $now->format('Y-m-d');

						$companyProjectAttendance = CompanyProjectAttendance::findByUserId($userID)
													->andWhere([
														'DATE(created_at)' => $currentDate,
														'status' => self::CLOCK_OUT
													])
													->orderBy(['id' => SORT_DESC])
													->one();

						if (!is_null($companyProjectAttendance)) {
							$response['data'] = [
								'companyProjectAttendanceID' => $companyProjectAttendance->id,
								'companyProjectAttendanceUserID' => $companyProjectAttendance->user_id,
								'companyProjectAttendanceProjectID' => $companyProjectAttendance->company_project_id,
								'companyProjectAttendanceProjectName' => $companyProjectAttendance->companyProject->name,
								'companyProjectAttendanceLatitude' => $companyProjectAttendance->latitude,
								'companyProjectAttendanceLongitude' => $companyProjectAttendance->longitude,
								'companyProjectAttendanceStatus' => $companyProjectAttendance->status,
								'companyProjectAttendanceTime' => $companyProjectAttendance->created_at,
							];

							//push current attendance to attendance array list
							array_push($attendance['currentProjectAttendance'], $response['data']);

							$updateCompanyProjectAttendanceSummary = self::updateCompanyProjectAttendanceSummary($attendance['currentProjectAttendance'], $timezone, $companyProjectID, $attendance['cycleStartTime']);
						}
					} else {
						$errors = $model->getErrors();
			            $response['hasErrors'] = $model->hasErrors();

			            $errorList = array();
			            foreach ($errors as $key => $value) {
			                array_push($errorList, [
			                    'errorField' => $key,
			                    'errorMessage' => $value[0]
			                ]);
			            }

			            $response['message'] = $errorList[0]['errorMessage'];
					}
				}
			}
		}

		return $response;
	}

	public function updateCompanyProjectAttendanceSummary($dataAttendance = [], $timezone = 'Asia/Jakarta', $companyProjectID = null, $cycleStartTime = 0) {
		$userID = Yii::$app->user->id;

		//get current date
		$now = new \DateTime("now", new \DateTimeZone($timezone) );
		$currentDate = $now->format('Y-m-d');

		$calculation = self::calculateWorkingHours($dataAttendance, $timezone, $cycleStartTime);

		$model = CompanyProjectAttendanceSummary::find()
								->andWhere([
									'user_id' => $userID,
									'DATE(created_at)' => $currentDate
								]);

		if (!is_null($companyProjectID)) {
			$model = $model->andWhere(['company_project_id' => $companyProjectID]);
		}
		
		$model = $model->one();

		if (is_null($model)) {
			$model = new CompanyProjectAttendanceSummary();	
		}

		$model->user_id = $calculation['userID'];
		$model->company_role_id = $calculation['companyRoleID'];
		$model->company_project_id = $companyProjectID;
		$model->projects = $calculation['projectNames'];
		$model->work_duration = $calculation['totalWorkingTime'];
		$model->overtime_duration_1 = $calculation['totalOvertime1'];
		$model->overtime_duration_2 = $calculation['totalOvertime2'];
		$model->overtime_duration_3 = $calculation['totalOvertime3'];
		$model->total_allowance = $calculation['totalAllowance'];

		if ($model->save()) {
			return true;
		} else {
			return false;
		}
	}

	public function calculateWorkingHours($dataAttendance = [], $timezone = 'Asia/Jakarta', $cycleStartTime = 0) {
		if (is_null($timezone)) {
			$timezone = 'Asia/Jakarta';
		}

		date_default_timezone_set($timezone);

		$userID = Yii::$app->user->id;
		$companyRoleID = Yii::$app->user->identity->company_role_id;
		$companyID = Yii::$app->user->identity->company->id;
		$companyClocks = CompanyClock::find()
						 	->andWhere([
						 		'company_id' => $companyID
						 	])
						 	->orderBy([
						 		'clock_in' => SORT_ASC
						 	])
						 	->all();

		//pairing clock in & clock out in 1 array index
		$pairedAttendanceHistory = array();
		$projectNames = array();
		$indexCounter = 0;
		foreach ($dataAttendance as $attendance) {
			if (!in_array($attendance['companyProjectAttendanceProjectName'], $projectNames)) {
				array_push($projectNames, $attendance['companyProjectAttendanceProjectName']);
			}

			if ($attendance['companyProjectAttendanceStatus'] == self::CLOCK_IN) {
				$pairedAttendanceHistory[$indexCounter]['clockIn'] = strtotime($attendance['companyProjectAttendanceTime']);
			}

			if ($attendance['companyProjectAttendanceStatus'] == self::CLOCK_OUT) {
				$pairedAttendanceHistory[$indexCounter]['clockOut'] = strtotime($attendance['companyProjectAttendanceTime']);

				$indexCounter++;
			}
		}

		$totalMainWorkingTime = 0;
		$totalOvertime1 = 0;
		$totalOvertime2 = 0;
		$totalOvertime3 = 0;
		$allowance1 = 0;
		$allowance2 = 0;
		$allowance3 = 0;
		$workingTimeCounter = 0;
		$currentTime = time();
		//loop company clocks to check user's attendance history
		$log = array();
		foreach ($companyClocks as $item) {
			$companyClockIn = strtotime($item['clock_in']);
			$companyClockOut = strtotime($item['clock_out']);

			// dd(date('Y-m-d H:i:s', $currentTime));
			
			if ($companyClockOut < $companyClockIn) { //if clock out time is in different day (overtime)
				// $companyClockIn -= self::TIME_ONE_DAY;
				$companyClockOut += self::TIME_ONE_DAY;
			}

			foreach ($pairedAttendanceHistory as $attendance) {
				$totalWorkingMinutes = 0;
				$start = 0;
				$stop = 0;

				//if user comes early, then start using company's clock in
				if ($attendance['clockIn'] <= $companyClockIn) {
					$start = $companyClockIn;
				} else {
					//if user comes after company's clock out, then exclude from calculation
					if ($attendance['clockIn'] > $companyClockOut) {
						continue;
					} else {//if user comes late, then start using user's clock in
						$start = $attendance['clockIn'];
					}
				}

				//if user finish early, then stop using user's clock out
				if ($attendance['clockOut'] <= $companyClockOut) {
					//if user's clock out time is earlier than company's clock in time, exclude from calculation
					if ($attendance['clockOut'] < $companyClockIn) {
						continue;
					} else {
						$stop = $attendance['clockOut'];	
					}
				} else {
					$stop = $companyClockOut;
				}

				//calculate total working time from start to stop time
				$totalWorkingMinutes = round(abs($stop - $start) / 60);

				//if user's attendance is within main working time
				if ($workingTimeCounter == 0) {
					$totalMainWorkingTime += $totalWorkingMinutes;
				} else { //if user's attendance is within overtime
					// return date('Y-m-d H:i:s', $stop). '|' . date('Y-m-d H:i:s', $start);
					${'totalOvertime' . $workingTimeCounter} += $totalWorkingMinutes;

					//total allowance if any
					${'allowance' . $workingTimeCounter} = $item['allowance'];
				}

				/*array_push($log, [
					'totalWorkingMinutes' => $totalWorkingMinutes,
					'workingTimeCounter' => $workingTimeCounter,
					'companyCI' => date('Y-m-d H:i:s', $companyClockIn),
					'companyCO' => date('Y-m-d H:i:s', $companyClockOut),
					'ci' => date('Y-m-d H:i:s', $attendance['clockIn']),
					'co' => date('Y-m-d H:i:s', $attendance['clockOut']),
					'start' => date('Y-m-d H:i:s', $start),
					'stop' => date('Y-m-d H:i:s', $stop),
					'clock' => $item->name,
					'totalMainWorkingTime' => $totalMainWorkingTime,
					'breakHour' => $item['break_hour']
				]);*/
			}

			//total working time minus break hour
			$breakHour = ($item['break_hour'] * 60);
			$totalMainWorkingTime -= $breakHour;

			$workingTimeCounter++;
		}
// dd($log);
		$concatenatedProjectNames = '';
		$counter = 0;
		foreach ($projectNames as $project) {
			if ($counter == 0) {
				$concatenatedProjectNames .= $project;
			} else {
				$concatenatedProjectNames .= ', ' . $project;
			}
			
			$counter++;
		}

		//calculate
		$totalMainWorkingTime = round($totalMainWorkingTime / 60);
		$totalOvertime1 = round($totalOvertime1 / 60);
		$totalOvertime2 = round($totalOvertime2 / 60);
		$totalOvertime3 = round($totalOvertime3 / 60);
		$allowance1 = $totalOvertime1 > 0 ? $allowance1 : 0;
		$allowance2 = $totalOvertime2 > 0 ? $allowance2 : 0;
		$allowance3 = $totalOvertime3 > 0 ? $allowance3 : 0;
		$totalAllowance = $allowance1 + $allowance2 + $allowance3;

		$response = [
			'userID' => $userID,
			'companyRoleID' => $companyRoleID,
			'projectNames' => $concatenatedProjectNames,
			'totalWorkingTime' => ($totalMainWorkingTime < 0) ? 0 : $totalMainWorkingTime,
			'totalOvertime1' => ($totalOvertime1 < 0) ? 0 : $totalOvertime1,
			'totalOvertime2' => ($totalOvertime2 < 0) ? 0 : $totalOvertime2,
			'totalOvertime3' => ($totalOvertime3 < 0) ? 0 : $totalOvertime3,
			'totalAllowance' => ($totalAllowance < 0) ? 0 : $totalAllowance
		];

		return $response;
	}
}
