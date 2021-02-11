<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;
use api\modules\v2\models\User;

class CompanyRole extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_role}}';
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['company_role_id' => 'id']);
    }
}