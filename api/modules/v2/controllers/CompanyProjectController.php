<?php

namespace api\modules\v2\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v2\models\CompanyProject;

class CompanyProjectController extends ActiveController
{
	public $modelClass = 'api\modules\v2\models\CompanyProject';

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
        $params = Yii::$app->request->post();

        $companyProjectID = null;
        if (isset($params['companyProjectID'])) {
            $companyProjectID = $params['companyProjectID'];    
        }
        
        $companyID = Yii::$app->user->identity->company_id;

        $data['hasErrors'] = false;
        $companyProjects = CompanyProject::findByCompanyId($companyID);

        if (!is_null($companyProjectID)) {
        	$companyProjects = $companyProjects->andWhere(['id' => $companyProjectID]);
        }
        
        $companyProjects = $companyProjects->all();

        $list = array();
        foreach ($companyProjects as $item) {
        	array_push($list, [
        		'companyProjectID' => $item->id,
        		'companyProjectName' => $item->name,
        		'companyProjectDescription' => $item->description,
        		'companyProjectLatitude' => $item->latitude,
        		'companyProjectLongitude' => $item->longitude,
        		'companyProjectRadius' => is_null($item->radius) ? null : (string) $item->radius,
        		'companyProjectClockInTime' => $item->clock_in,
        		'companyProjectClockOutTime' => $item->clock_out,
        		'companyProjectCreatedAt' => $item->created_at,
        	]);
        }

        $data['companyProjects'] = $list;
        return $data;
    }
}
