<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyLimitation]].
 *
 * @see CompanyLimitation
 */
class CompanyLimitationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CompanyLimitation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyLimitation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
