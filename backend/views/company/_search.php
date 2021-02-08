<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>

    <?= $form->field($model, 'image_filename')->textInput(['maxlength' => true, 'placeholder' => 'Image Filename']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php /* echo $form->field($model, 'hour_rounding')->textInput(['placeholder' => 'Hour Rounding']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
