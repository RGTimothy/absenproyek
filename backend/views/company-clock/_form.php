<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyClock */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="company-clock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php /*$form->field($model, 'company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Company')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);*/ ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'clock_in')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Clock In'),
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'clock_out')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Clock Out'),
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'allowance')->textInput(['placeholder' => 'Allowance']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
