<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_clock".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $clock_in
 * @property string|null $clock_out
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 *
 * @property Company $company
 */
class CompanyClock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_clock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'name' => Yii::t('app', 'Name'),
            'clock_in' => Yii::t('app', 'Clock In'),
            'clock_out' => Yii::t('app', 'Clock Out'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * {@inheritdoc}
     * @return CompanyClockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyClockQuery(get_called_class());
    }
}
