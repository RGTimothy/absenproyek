<?php
namespace api\modules\v2\models;

use Yii;
use yii\db\ActiveRecord;
// use yii\web\IdentityInterface;
use api\modules\v2\models\User;
use api\modules\v2\models\Company;

class CompanyInformation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_information}}';
    }

    public function getCompany() {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public static function findByCompanyId($companyID)
    {
        return static::find()->where(['company_id' => $companyID]);
    }
}