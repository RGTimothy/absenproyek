<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyInformation as BaseCompanyInformation;

/**
 * This is the model class for table "company_information".
 */
class CompanyInformation extends BaseCompanyInformation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 100]
        ]);
    }
	
}
