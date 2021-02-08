<?php

namespace backend\models;
use Yii;

/**
 * This is the ActiveQuery class for [[CompanyRole]].
 *
 * @see CompanyRole
 */
class CompanyRoleQuery extends \yii\db\ActiveQuery
{
    public function init()
    {
        $companyID = Yii::$app->user->identity->company_id;
        $companyRoleID = Yii::$app->user->identity->company_role_id;

        if (!is_null($companyID)) {
            $this->andOnCondition(['company_id' => $companyID]);
            // $this->andOnCondition('id <> ' . $companyRoleID);
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
