<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v1\models\CompanyProjectAttendance;
use api\modules\v1\models\CompanyProjectAttendanceSummary;
use api\modules\v1\models\CompanyClock;

class CompanyProjectAttendanceController extends ActiveController
{
	const IMAGE_FOLDER = 'attendance_images';

	const CLOCK_IN = 'CLOCK_IN',
		  CLOCK_OUT = 'CLOCK_OUT';

	public $modelClass = 'api\modules\v1\models\CompanyProjectAttendance';

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

	public function actionStatus() {
		$userID = Yii::$app->user->id;
		$headers = Yii::$app->request->headers;

		//set user's timezone
		$timezone =  $headers->get('timezone');
		if (is_null($timezone)) {
			$timezone = 'Asia/Jakarta';
		}

		//get current date
		$now = new \DateTime("now", new \DateTimeZone($timezone) );
		$currentDate = $now->format('Y-m-d');

		//get attendance based on current date
		$attendances = CompanyProjectAttendance::findByUserId($userID)
						->andWhere(['DATE(created_at)' => $currentDate])
						->orderBy(['id' => SORT_ASC])
						->all();

		$todayAttendanceHistory = array();
		$clockInStatus = false;
		$clockOutStatus = false;
		$lastState = null;
		foreach ($attendances as $item) {
			if ($item->status == self::CLOCK_IN) {
				array_push($todayAttendanceHistory, [
					'companyProjectAttendanceID' => $item->id,
					'companyProjectAttendanceUserID' => $item->user_id,
					'companyProjectAttendanceProjectID' => $item->company_project_id,
					'companyProjectAttendanceProjectName' => $item->companyProject->name,
					'companyProjectAttendanceLatitude' => $item->latitude,
					'companyProjectAttendanceLongitude' => $item->longitude,
					'companyProjectAttendanceStatus' => $item->status,
					'companyProjectAttendanceTime' => $item->created_at,
				]);
				$lastState = self::CLOCK_IN;
			}

			if ($item->status == self::CLOCK_OUT) {
				array_push($todayAttendanceHistory, [
					'companyProjectAttendanceID' => $item->id,
					'companyProjectAttendanceUserID' => $item->user_id,
					'companyProjectAttendanceProjectID' => $item->company_project_id,
					'companyProjectAttendanceProjectName' => $item->companyProject->name,
					'companyProjectAttendanceLatitude' => $item->latitude,
					'companyProjectAttendanceLongitude' => $item->longitude,
					'companyProjectAttendanceStatus' => $item->status,
					'companyProjectAttendanceTime' => $item->created_at,
				]);
				$lastState = self::CLOCK_OUT;
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
		$response['data'] = $todayAttendanceHistory;

		// return self::calculateWorkingHours($todayAttendanceHistory);
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
		$attendance = self::actionStatus();

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

					$updateCompanyProjectAttendanceSummary = self::updateCompanyProjectAttendanceSummary($attendance['data'], $timezone);
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
		$attendance = self::actionStatus();

		if ($attendance['lastState'] == self::CLOCK_OUT) {
			$response['hasErrors'] = true;
			$response['message'] = 'Fail. You have been clocked out before.';
		} else if (is_null($attendance['lastState'])) {
			$response['hasErrors'] = true;
			$response['message'] = 'Fail. You have to clock in first before doing clock out.';
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

					$updateCompanyProjectAttendanceSummary = self::updateCompanyProjectAttendanceSummary($attendance['data'], $timezone);
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

	public function updateCompanyProjectAttendanceSummary($dataAttendance = [], $timezone = 'Asia/Jakarta') {
		$userID = Yii::$app->user->id;

		//get current date
		$now = new \DateTime("now", new \DateTimeZone($timezone) );
		$currentDate = $now->format('Y-m-d');

		$calculation = self::calculateWorkingHours($dataAttendance, $timezone);

		$model = CompanyProjectAttendanceSummary::find()
								->andWhere([
									'user_id' => $userID,
									'DATE(created_at)' => $currentDate
								])
								->one();

		if (is_null($model)) {
			$model = new CompanyProjectAttendanceSummary();	
		}

		$model->user_id = $calculation['userID'];
		$model->company_role_id = $calculation['companyRoleID'];
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

	public function calculateWorkingHours($dataAttendance = [], $timezone = 'Asia/Jakarta') {
		if (is_null($timezone)) {
			$timezone = 'Asia/Jakarta';
		}

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
		//loop company clocks to check user's attendance history
		$workingTimeCounter = 0;
		foreach ($companyClocks as $item) {
			$companyClockIn = strtotime($item['clock_in']);
			$companyClockOut = strtotime($item['clock_out']);

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

					//total working time minus break hour
					$totalMainWorkingTime -= ($item['break_hour'] * 60);
				} else { //if user's attendance is within overtime
					// return date('Y-m-d H:i:s', $stop). '|' . date('Y-m-d H:i:s', $start);
					${'totalOvertime' . $workingTimeCounter} += $totalWorkingMinutes;

					//total allowance if any
					${'allowance' . $workingTimeCounter} = $item['allowance'];
				}
			}

			$workingTimeCounter++;
		}

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
			'totalWorkingTime' => $totalMainWorkingTime,
			'totalOvertime1' => $totalOvertime1,
			'totalOvertime2' => $totalOvertime2,
			'totalOvertime3' => $totalOvertime3,
			'totalAllowance' => $totalAllowance
		];

		return $response;
	}
}
