<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
	public $modelClass = 'api\modules\v1\models\User';

	public function actions() {
        $actions = parent::actions();
        // unset($actions['create']);
        return $actions;
    }

    public function actionCreate() {
    	$request = Yii::$app->getRequest()->getBodyParams();
        return $request['username'];
    }
}
