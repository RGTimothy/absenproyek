<?php

namespace backend\models;

use Yii;
use \backend\models\base\Company as BaseCompany;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['description'], 'string'],
            [['hour_rounding'], 'validateHourRounding'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'image_filename'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['code'], 'unique']
        ]);
    }

    public function validateHourRounding($attribute, $params, $validator, $current) {
        if (intval($current) <= 0) {
            $validator->addError($this, $attribute, '{attribute} harus diisi angka.');
        }
        if ($current > 60) {
            $validator->addError($this, $attribute, '{attribute} harus lebih kecil dari 60 menit.');
        }
    }
	
}
