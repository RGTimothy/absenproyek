<?php
namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyProjectUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_project_user}}';
    }

    public function getCompanies() {
        return $this->HasMany(Company::className(), ['company_id' => 'id']);
    }

    public function getUsers() {
        return $this->HasMany(User::className(), ['user_id' => 'id']);
    }
}