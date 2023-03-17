<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;
use api\modules\v2\models\User;
use api\modules\v2\models\CompanyInformation;
use api\modules\v2\models\CompanyLimitation;

class Company extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    public function relationNames()
    {
        return [
            'companyLimitation'
        ];
    }

    public static function findByCode($code) {
    	return static::find()->where(['code' => $code]);
    }

    public function getCompanyLimitation()
    {
        return $this->hasOne(CompanyLimitation::className(), ['company_id' => 'id']);
    }
}