<?php

namespace backend\models;

use Yii;
use \backend\models\base\CompanyProject as BaseCompanyProject;

/**
 * This is the model class for table "company_project".
 */
class CompanyProject extends BaseCompanyProject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['company_id', 'radius', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            // [['latitude', 'longitude'], 'filter', 'filter' => [$this, 'validateCoordinate']],
            [['latitude', 'longitude'], 'validateCoordinate', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['clock_in', 'clock_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 200]
        ]);
    }

    public function customValidation($attribute, $params, $validator, $current) {
        $validator->addError($this, $attribute, 'The {attribute} must be either "USA" or "Indonesia".');
    }
	
    public function validateCoordinate($attribute, $params, $validator, $current) {
        if ($current == null || $current == '') {
            $companyLimitation = Yii::$app->user->identity->companyLimitation;
            if (!is_null($companyLimitation)) {
                $limitUnrestrictedProject = $companyLimitation->max_unrestricted_project;
                $totalCurrentUnrestrictedProjects = CompanyProject::find()->where([
                                                        'latitude' => null,
                                                        'longitude' => null
                                                    ])->count();

                if ($totalCurrentUnrestrictedProjects >= $limitUnrestrictedProject) {
                    $validator->addError($this, $attribute, '{attribute} harus diisi. Total proyek tanpa koordinat sudah mencapai limit.');
                }
            }    
        }
    }

    public function validateTotalProject() {
        $companyLimitation = Yii::$app->user->identity->companyLimitation;

        $limitMaxProjects = $companyLimitation->max_project;
        $totalActiveProjects = CompanyProject::find()->count();

        if ($totalActiveProjects >= $limitMaxProjects) {
            Yii::$app->session->setFlash('error', 'Total proyek sudah mencapai limit ('. $limitMaxProjects .' proyek). Anda bisa menghapus proyek yang ada saat ini atau hubungi tim Hadirbos untuk melakukan peningkatan limit.');

            return false;
        }

        return true;
    }
}
