<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
// use yii\filters\auth\HttpHeaderAuth;

class CompanyInformationController extends ActiveController
{
	public $modelClass = 'api\modules\v1\models\CompanyInformation';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // $behaviors['basicAuth'] = ['class' => HttpHeaderAuth::className()];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                // HttpHeaderAuth::className(),
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionList() {
        return 'list here';
    }
}
