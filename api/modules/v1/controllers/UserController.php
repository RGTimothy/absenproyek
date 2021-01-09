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
            $response['isSuccess'] = 201;
            $response['message'] = 'You are now a member!';
            $response['user'] = User::findByUsername($model->username);
        }
        else {
            // $model->validate();

            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            
            // return $model;
        }

        return $response;
    }

    public function actionLogin() {
        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            $response = ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            // $model->validate();
            // return $model;

            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
        }

        return $response;
    }
}
