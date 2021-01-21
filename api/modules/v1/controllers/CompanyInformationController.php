<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
// use yii\filters\auth\HttpBasicAuth;
// use yii\filters\auth\HttpBearerAuth;
// use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v1\models\CompanyInformation;
use api\modules\v1\models\User;

class CompanyInformationController extends ActiveController
{
	public $modelClass = 'api\modules\v1\models\CompanyInformation';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpHeaderAuth::className(),
                // HttpBasicAuth::className(),
                // HttpBearerAuth::className(),
                // QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionList() {
        // return Yii::$app->cache->flush();
        $companyID = Yii::$app->user->identity->company_id;

        $data['hasErrors'] = false;
        $companyInformations = CompanyInformation::findByCompanyId($companyID)->all();

        $list = array();
        foreach ($companyInformations as $item) {
            array_push($list, [
                'companyInformationID' => $item->id,
                'companyInformationTitle' => $item->title,
                'companyInformationDescription' => $item->description,
                'companInformationCreatedAt' => $item->created_at,
                'companyName' => $item->company->name,
            ]);
        }

        $data['data'] = $list;
        return $data;
    }
}
