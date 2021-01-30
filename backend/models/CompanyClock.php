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
            [['company_id'], 'integer'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'name' => Yii::t('app', 'Name'),
            'clock_in' => Yii::t('app', 'Clock In'),
            'clock_out' => Yii::t('app', 'Clock Out'),
        ];
    }
}
