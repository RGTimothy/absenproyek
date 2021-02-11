<?php

namespace api\modules\v2\controllers;

use yii;
use yii\rest\ActiveController;
// use api\modules\v1\models\CompanyInformation;

class CompanyController extends ActiveController
{
	public $modelClass = 'api\modules\v2\models\Company';
}
