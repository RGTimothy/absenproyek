<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyProjectAttendanceSummary]].
 *
 * @see CompanyProjectAttendanceSummary
 */
class CompanyProjectAttendanceSummaryQuery extends \yii\db\ActiveQuery
{
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
