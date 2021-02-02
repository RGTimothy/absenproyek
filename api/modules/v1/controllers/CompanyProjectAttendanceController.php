<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v1\models\CompanyProjectAttendance;

class CompanyProjectAttendanceController extends ActiveController
{
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
						->all();

		$todayAttendanceHistory = array();
		$clockInStatus = false;
		$clockOutStatus = false;
		foreach ($attendances as $item) {
			if ($item->status == self::CLOCK_IN) {
				$clockInStatus = true;
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
			}

			if ($item->status == self::CLOCK_OUT) {
				$clockOutStatus = true;
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
			}
		}

		$response['hasErrors'] = false;
		$response['clockInStatus'] = $clockInStatus;
		$response['clockOutStatus'] = $clockOutStatus;
		$response['data'] = $todayAttendanceHistory;
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

		if ($attendance['hasErrors'] == false && ($attendance['clockInStatus'] == false && $attendance['clockOutStatus'] == false)) {
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

            $model->image = $decodedImage;
			$model->status = self::CLOCK_IN;

			if ($model->save()) {
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
											->where(['status' => self::CLOCK_IN])
											->andWhere(['DATE(created_at)' => $currentDate])
											->one();

				if (count($companyProjectAttendance > 0)) {
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
		} else {
			$response['hasErrors'] = true;
			if ($attendance['clockInStatus'] == true) {
				$response['message'] = 'Fail. You have been clocked in before.';
			} else if ($attendance['clockOutStatus'] == true) {
				$response['message'] = 'Fail. You have been clocked out for today.';
			} else {
				$response['message'] = 'Fail. Unknown error, please try again.';
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

		if ($attendance['hasErrors'] == false && ($attendance['clockOutStatus'] == false && $attendance['clockInStatus'] == true)) {
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

            $model->image = $decodedImage;
			$model->status = self::CLOCK_OUT;

			if ($model->save()) {
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
											->where(['status' => self::CLOCK_OUT])
											->andWhere(['DATE(created_at)' => $currentDate])
											->one();

				if (count($companyProjectAttendance > 0)) {
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
		} else {
			$response['hasErrors'] = true;
			if ($attendance['clockOutStatus'] == true) {
				$response['message'] = 'Fail. You have been clocked out before.';
			} else if ($attendance['clockInStatus'] == false) {
				$response['message'] = 'Fail. You have to clock in first before doing clock out.';
			} else {
				$response['message'] = 'Fail. Unknown error, please try again.';
			}
		}

		return $response;
	}
}
