<?php

namespace backend\models;
use Yii;

/**
 * This is the ActiveQuery class for [[CompanyProjectAttendanceSummary]].
 *
 * @see CompanyProjectAttendanceSummary
 */
class CompanyProjectAttendanceSummaryQuery extends \yii\db\ActiveQuery
{
    public function init()
    {
        $companyID = Yii::$app->user->identity->company_id;

        if (!is_null($companyID)) {
            $this->leftJoin('user', '`user`.`id` = `company_project_attendance_summary`.`user_id`')
                ->onCondition(['user.deleted_at' => null])
                ->andOnCondition(['user.company_id' => $companyID]);
        }
        
        parent::init();
    }

    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CompanyProjectAttendanceSummary[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyProjectAttendanceSummary|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
