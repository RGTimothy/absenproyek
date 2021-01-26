<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_information".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 *
 * @property Company $company
 */
class CompanyInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['description'], 'string'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
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
     * @return CompanyInformationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyInformationQuery(get_called_class());
    }
}
