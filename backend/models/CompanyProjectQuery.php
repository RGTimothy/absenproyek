<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyProject]].
 *
 * @see CompanyProject
 */
class CompanyProjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompanyProject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompanyProject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
