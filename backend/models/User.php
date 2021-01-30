<?php

namespace backend\models;

use Yii;
use \backend\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['company_role'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['phone'], 'unique'],
            [['username'], 'unique'],
            [['email'], 'unique']
        ]);
    }
	
}
