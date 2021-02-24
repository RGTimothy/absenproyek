<?php

namespace backend\models;
use Yii;

/**
 * This is the ActiveQuery class for [[CompanyLimitation]].
 *
 * @see CompanyLimitation
 */
class CompanyLimitationQuery extends \yii\db\ActiveQuery
{
    public function init()
    {
        $companyID = Yii::$app->user->identity->company_id;

        if (!is_null($companyID)) {
            $this->andOnCondition(['company_id' => $companyID]);
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
