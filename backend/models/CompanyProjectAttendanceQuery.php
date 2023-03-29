<?php

namespace backend\models;
use Yii;

/**
 * This is the ActiveQuery class for [[CompanyProjectAttendance]].
 *
 * @see CompanyProjectAttendance
 */
class CompanyProjectAttendanceQuery extends \yii\db\ActiveQuery
{
    public function init()
    {
        $companyID = Yii::$app->user->identity->company_id;

        if (!is_null($companyID)) {
            $this->leftJoin('user', '`user`.`id` = `company_project_attendance`.`user_id`')
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
     * @return CompanyProjectAttendance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyProjectAttendance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
