<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyProjectAttendance]].
 *
 * @see CompanyProjectAttendance
 */
class CompanyProjectAttendanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompanyProjectAttendance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompanyProjectAttendance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
