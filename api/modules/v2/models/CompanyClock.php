<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyClock extends ActiveRecord
{
    const DEFAULT_WORKING_TIME = 1,
          OVERTIME = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_clock}}';
    }

    public function rules()
    {
        return [
            [['company_id', 'break_hour', 'allowance', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['is_default'], 'string', 'max' => 1]
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(\backend\models\Company::className(), ['id' => 'company_id']);
    }
}