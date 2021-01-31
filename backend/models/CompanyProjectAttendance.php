<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyProjectAttendance as BaseCompanyProjectAttendance;

/**
 * This is the model class for table "company_project_attendance".
 */
class CompanyProjectAttendance extends BaseCompanyProjectAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'company_project_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['remark', 'image'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status'], 'string', 'max' => 20],
            [['image_filename'], 'string', 'max' => 100],
            [['image_filetype'], 'string', 'max' => 50]
        ]);
    }
	
}
