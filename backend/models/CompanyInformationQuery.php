<?php

namespace backend\models;
use Yii;

/**
 * This is the ActiveQuery class for [[CompanyInformation]].
 *
 * @see CompanyInformation
 */
class CompanyInformationQuery extends \yii\db\ActiveQuery
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
     * @return CompanyInformation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyInformation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
