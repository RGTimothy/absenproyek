<?php

namespace backend\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "company_project".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $name
 * @property string $description
 * @property string $latitude
 * @property string $longitude
 * @property integer $radius
 * @property string $clock_in
 * @property string $clock_out
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property \backend\models\Company $company
 * @property \backend\models\CompanyProjectAttendance[] $companyProjectAttendances
 */
class CompanyProject extends \yii\db\ActiveRecord
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
            'company',
            'companyProjectAttendances'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'radius', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_project';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Perusahaan'),
            'name' => Yii::t('app', 'Nama'),
            'description' => Yii::t('app', 'Deskripsi'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'radius' => Yii::t('app', 'Radius'),
            'clock_in' => Yii::t('app', 'Jam Masuk'),
            'clock_out' => Yii::t('app', 'Jam Keluar'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\backend\models\Company::className(), ['id' => 'company_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyProjectAttendances()
    {
        return $this->hasMany(\backend\models\CompanyProjectAttendance::className(), ['company_project_id' => 'id']);
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
     * @return \backend\models\CompanyProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \backend\models\CompanyProjectQuery(get_called_class());
        return $query->where(['company_project.deleted_by' => 0]);
    }
}
