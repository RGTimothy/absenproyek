<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpHeaderAuth;
use api\modules\v1\models\CompanyInformation;

class CompanyController extends ActiveController
{
	public $modelClass = 'api\modules\v1\models\Company';
}
