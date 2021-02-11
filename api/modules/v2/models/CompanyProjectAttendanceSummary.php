<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;

class CompanyProjectAttendanceSummary extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_project_attendance_summary}}';
    }

    public function relationNames()
    {
        return [
            'companyRole',
            'user'
        ];
    }

    public function rules() {
        return [
            [['user_id', 'company_role_id', 'work_duration', 'overtime_duration_1', 'overtime_duration_2', 'overtime_duration_3', 'total_allowance', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['projects'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRole()
    {
        return $this->hasOne(CompanyRole::className(), ['id' => 'company_role_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}