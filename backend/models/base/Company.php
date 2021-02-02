<?php

namespace backend\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $image_filename
 * @property string $description
 * @property integer $hour_rounding
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property \backend\models\CompanyClock[] $companyClocks
 * @property \backend\models\CompanyInformation[] $companyInformations
 * @property \backend\models\CompanyLimitation[] $companyLimitations
 * @property \backend\models\CompanyProject[] $companyProjects
 * @property \backend\models\CompanyRole[] $companyRoles
 * @property \backend\models\User[] $users
 */
class Company extends \yii\db\ActiveRecord
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
            'companyClocks',
            'companyInformations',
            'companyLimitations',
            'companyProjects',
            'companyRoles',
            'users'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['hour_rounding'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'image_filename'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'image_filename' => Yii::t('app', 'Image Filename'),
            'description' => Yii::t('app', 'Description'),
            'hour_rounding' => Yii::t('app', 'Hour Rounding'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyClocks()
    {
        return $this->hasMany(\backend\models\CompanyClock::className(), ['company_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyInformations()
    {
        return $this->hasMany(\backend\models\CompanyInformation::className(), ['company_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyLimitations()
    {
        return $this->hasMany(\backend\models\CompanyLimitation::className(), ['company_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyProjects()
    {
        return $this->hasMany(\backend\models\CompanyProject::className(), ['company_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRoles()
    {
        return $this->hasMany(\backend\models\CompanyRole::className(), ['company_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\backend\models\User::className(), ['company_id' => 'id']);
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
     * @return \backend\models\CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \backend\models\CompanyQuery(get_called_class());
        return $query->where(['company.deleted_by' => 0]);
    }
}
