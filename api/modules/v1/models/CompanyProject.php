<?php
namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyProject extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_project}}';
    }

    public function getCompany() {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getCompanyProjectAttendances() {
        return $this->hasMany(CompanyProjectAttendance::className(), ['id' => 'company_project_id']);
    }

    public static function findByCompanyId($companyID)
    {
        return static::find()->where(['company_id' => $companyID]);
    }
}