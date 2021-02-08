<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendanceSummarySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-company-project-attendance-summary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'company_role_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\CompanyRole::find()->orderBy('id')->asArray()->all(), 'id', 'code'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Company role')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'projects')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'work_duration')->textInput(['placeholder' => 'Work Duration']) ?>

    <?php /* echo $form->field($model, 'overtime_duration_1')->textInput(['placeholder' => 'Overtime Duration 1']) */ ?>

    <?php /* echo $form->field($model, 'overtime_duration_2')->textInput(['placeholder' => 'Overtime Duration 2']) */ ?>

    <?php /* echo $form->field($model, 'overtime_duration_3')->textInput(['placeholder' => 'Overtime Duration 3']) */ ?>

    <?php /* echo $form->field($model, 'total_allowance')->textInput(['placeholder' => 'Total Allowance']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
