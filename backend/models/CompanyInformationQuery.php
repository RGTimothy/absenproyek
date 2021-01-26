<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyInformation]].
 *
 * @see CompanyInformation
 */
class CompanyInformationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompanyInformation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompanyInformation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
