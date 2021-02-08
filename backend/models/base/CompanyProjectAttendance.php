<?php

namespace backend\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "company_project_attendance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_project_id
 * @property string $latitude
 * @property string $longitude
 * @property string $status
 * @property string $remark
 * @property resource $image
 * @property string $image_filename
 * @property string $image_filetype
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property \backend\models\CompanyProject $companyProject
 * @property \backend\models\User $user
 */
class CompanyProjectAttendance extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'companyProject',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'company_project_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['remark', 'image'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status'], 'string', 'max' => 20],
            [['image_filename'], 'string', 'max' => 100],
            [['image_filetype'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_project_attendance';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Karyawan'),
            'company_project_id' => Yii::t('app', 'Proyek'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Catatan'),
            'image' => Yii::t('app', 'Foto'),
            'image_filename' => Yii::t('app', 'Image Filename'),
            'image_filetype' => Yii::t('app', 'Image Filetype'),
            'created_at' => Yii::t('app', 'Waktu'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyProject()
    {
        return $this->hasOne(\backend\models\CompanyProject::className(), ['id' => 'company_project_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\backend\models\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \backend\models\CompanyProjectAttendanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \backend\models\CompanyProjectAttendanceQuery(get_called_class());
        // return $query->where(['company_project_attendance.deleted_by' => 0]);
        return $query;
    }
}
