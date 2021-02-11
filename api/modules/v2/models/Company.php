<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;
use api\modules\v2\models\User;
use api\modules\v2\models\CompanyInformation;

class Company extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    public static function findByCode($code) {
    	return static::find()->where(['code' => $code]);
    }
}