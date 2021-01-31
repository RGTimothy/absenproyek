<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyProject as BaseCompanyProject;

/**
 * This is the model class for table "company_project".
 */
class CompanyProject extends BaseCompanyProject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'radius', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 200]
        ]);
    }
	
}
