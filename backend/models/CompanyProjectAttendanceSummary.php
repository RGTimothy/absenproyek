<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyProjectAttendanceSummary as BaseCompanyProjectAttendanceSummary;

/**
 * This is the model class for table "company_project_attendance_summary".
 */
class CompanyProjectAttendanceSummary extends BaseCompanyProjectAttendanceSummary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'company_role_id', 'work_duration', 'overtime_duration_1', 'overtime_duration_2', 'overtime_duration_3', 'total_allowance', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['projects'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ]);
    }
	
}
