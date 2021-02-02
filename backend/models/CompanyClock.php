<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyClock as BaseCompanyClock;

/**
 * This is the model class for table "company_clock".
 */
class CompanyClock extends BaseCompanyClock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'break_hour', 'allowance', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['is_default'], 'string', 'max' => 1]
        ]);
    }
	
}
