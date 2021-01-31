<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyRole as BaseCompanyRole;

/**
 * This is the model class for table "company_role".
 */
class CompanyRole extends BaseCompanyRole
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
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code'], 'string', 'max' => 100]
        ]);
    }
	
}
