<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyRole]].
 *
 * @see CompanyRole
 */
class CompanyRoleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CompanyRole[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyRole|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
