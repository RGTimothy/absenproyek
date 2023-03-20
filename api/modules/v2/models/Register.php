<?php

namespace api\modules\v2\models;

use Yii;
// use yii\base\Model;
use yii\db\ActiveRecord;
use api\modules\v2\models\User;
use api\modules\v2\models\CompanyLimitation;
use api\modules\v2\models\Company;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class Register extends ActiveRecord
{
    public $username;
    public $phone;
    public $email;
    public $password;
    public $code;

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\api\modules\v1\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 5, 'max' => 30],
            ['username', 'filter', 'filter' => [$this, 'checkUsername']],

            ['phone', 'required'],
            ['phone', 'unique'],
            ['phone', 'filter', 'filter' => [$this, 'normalizePhone']],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'default', 'value' => null],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\api\modules\v1\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['status', 'default', 'value' => User::STATUS_INACTIVE],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE, User::STATUS_DELETED]],

            [['password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'unique'],

            ['code', 'string', 'max' => 100],
            ['code', 'required'],
            ['code', 'filter', 'filter' => [$this, 'getCompanyIdByCode']],

            ['company_role_id', 'integer'],
        ];
    }

    public function getCompanyIdByCode() {
        $company = Company::findByCode($this->code)->one();
        if (is_null($company)) {
            $this->addError($attribute, 'Your company code is not found. Please contact us to use this app for your company.');
        } else {
            return $company->id;
        }
    }

    public function checkUsername($value) {
        //returns true / false (preg_replace returns the string with replaced matched regex)
        if (preg_match('/\s+/', $value)) {
           $this->addError($attribute, 'Username tidak boleh ada spasi.');
        } else {
            return $value;
        }
    }

    public function validateTotalUser($companyCode) {
        $company = Company::find()->where(['company.code' => $companyCode])->one();
        if (is_null($company)) {
            $this->addError('*', 'Kode perusahaan tidak ditemukan. Hubungi tim kami untuk informasi lebih lanjut.');
        } else {
            $companyID = $company->id;
            $totalActiveUsers = User::find()->where(['user.company_id' => $companyID, 'user.deleted_by' => 0])->count();

            if (isset($company->companyLimitation->max_user)) {
                // when company has limitation
                $limitMaxUsers = $company->companyLimitation->max_user;
            } else {
                // when company has no limitation yet
                $limitMaxUsers = $totalActiveUsers * 2;
            }
            

            if ($totalActiveUsers >= $limitMaxUsers) {
                $this->addError('*', 'Jumlah karyawan sudah mencapai batas limit. Hubungi admin perusahaan anda untuk meningkatkan limit.');
            }
        }
    }

    public function normalizePhone($value) {
        return $value;
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->status = $user::STATUS_ACTIVE;
        $user->company_id = intval($this->code);
        $user->company_role_id = $this->company_role_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // $this->sendEmail($user);
        return $user->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
