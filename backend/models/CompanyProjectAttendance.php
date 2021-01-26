<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_project_attendance".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $company_project_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $status
 * @property resource|null $image
 * @property string|null $image_filename
 * @property string|null $image_filetype
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 *
 * @property CompanyProject $companyProject
 * @property User $user
 */
class CompanyProjectAttendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_project_attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'company_project_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['image'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status'], 'string', 'max' => 20],
            [['image_filename'], 'string', 'max' => 100],
            [['image_filetype'], 'string', 'max' => 50],
            [['company_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProject::className(), 'targetAttribute' => ['company_project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'company_project_id' => Yii::t('app', 'Company Project ID'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'status' => Yii::t('app', 'Status'),
            'image' => Yii::t('app', 'Image'),
            'image_filename' => Yii::t('app', 'Image Filename'),
            'image_filetype' => Yii::t('app', 'Image Filetype'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[CompanyProject]].
     *
     * @return \yii\db\ActiveQuery|CompanyProjectQuery
     */
    public function getCompanyProject()
    {
        return $this->hasOne(CompanyProject::className(), ['id' => 'company_project_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CompanyProjectAttendanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyProjectAttendanceQuery(get_called_class());
    }
}
