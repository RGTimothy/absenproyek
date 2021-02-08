<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyLimitation as BaseCompanyLimitation;

/**
 * This is the model class for table "company_limitation".
 */
class CompanyLimitation extends BaseCompanyLimitation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'max_user', 'max_project', 'max_unrestricted_project', 'max_grade', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['max_subscription_time', 'created_at', 'updated_at', 'deleted_at'], 'safe']
        ]);
    }
	
}
