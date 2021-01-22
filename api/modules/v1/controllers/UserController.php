<?php

namespace api\modules\v1\controllers;

use yii;
use yii\base\Model;
use yii\rest\ActiveController;
use api\modules\v1\models\Register;
use api\modules\v1\models\User;
use api\modules\v1\models\Login;

class UserController extends ActiveController
{
	public $modelClass = 'api\modules\v1\models\User';

	public function actions() {
        $actions = parent::actions();

        // unset($actions['create']);
        // unset($actions['test']);
        return $actions;
    }

    public function actionPing() {
        return 'pong!';
    }

    public function actionRegister() {
    	// $request = Yii::$app->getRequest()->getBodyParams();
        // return $request['username'];

        $model = new Register();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->phone = $params['phone'];
        $model->email = $params['email'];

        $model->password = $params['password'];

        if ($model->signup()) {
            // $response['isSuccess'] = 201;
            $response['hasErrors'] = $model->hasErrors();
            $response['message'] = 'You are now a member!';
            // $response['user'] = User::findByUsername($model->username);
        }
        else {
            // $model->validate();
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

            // $response['errors'] = $errorList;
            // return $model;
        }

        return $response;
    }

    public function actionLogin() {
        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            // $response['isSuccess'] = 200;
            $userID = Yii::$app->user->id;
            $response['hasErrors'] = $model->hasErrors();
            $response['access_token'] = Yii::$app->user->identity->getAuthKey();

            $dataUser = User::findIdentity($userID);
            $logoUrl = $dataUser->company->image_filename;
            $response['data'] = [
                'userUsername' => $dataUser->username,
                'companyID' => $dataUser->company_id,
                'companyName' => $dataUser->company->name,
                'companyLogoUrl' => $logoUrl,
                'companyProjects' => [
                    'companyProjectID' => $dataUser->companyProjects[0]->id,
                    'companyProjectName' => $dataUser->companyProjects[0]->name,
                    'companyProjectDescription' => $dataUser->companyProjects[0]->description,
                    'companyProjectLatitude' => $dataUser->companyProjects[0]->latitude,
                    'companyProjectLongitude' => $dataUser->companyProjects[0]->longitude,
                    'companyProjectRadius' => $dataUser->companyProjects[0]->radius,
                    'companyProjectClockInTime' => $dataUser->companyProjects[0]->clock_in,
                    'companyProjectClockOutTime' => $dataUser->companyProjects[0]->clock_out,
                    'companyProjectCreatedAt' => $dataUser->companyProjects[0]->created_at,
                ],
            ];

        } else {
            // $model->validate();
            // return $model;

            $errors = $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            // $response['errors'] = $model->getErrors();

            $errorList = array();
            foreach ($errors as $key => $value) {
                array_push($errorList, [
                    'errorField' => $key,
                    'errorMessage' => $value[0]
                ]);
            }
            $response['message'] = $errorList[0]['errorMessage'];
        }

        return $response;
    }
}
