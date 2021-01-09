<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use api\modules\v1\models\User;

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

        $model = new User();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->phone = $params['phone'];
        $model->email = $params['email'];
        $model->password = $params['password'];
        $model->status = User::STATUS_ACTIVE;

        //generate required values
        $model->setPassword($params['password']);
        $model->generateAuthKey();
        $model->generateEmailVerificationToken();

        if ($model->save()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'You are now a member!';
            $response['user'] = User::findByUsername($model->username);
            return $response;
        }
        else {
            // $model->validate();

            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            
            // return $model;
            
            return $response;
        }
    }
}
