<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyLimitation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_limitation}}';
    }

    public function getCompany() {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}