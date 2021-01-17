<?php
namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyProjectAttendance extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_project_attendance}}';
    }

    public function rules() {
        return [
            ['company_project_id', 'integer'],
            ['company_project_id', 'required'],
            
            ['latitude', 'required'],
            
            ['longitude', 'required'],
        ];
    }

    public function getCompanies() {
        return $this->hasMany(Company::className(), ['id' => 'company_id']);
    }

    public function getCompanyProject() {
        return $this->hasOne(CompanyProject::className(), ['id' => 'company_project_id']);
    }

    public function getUsers() {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }

    public static function findByUserId($userID) {
        return static::find()->where(['user_id' => $userID]);
    }
}