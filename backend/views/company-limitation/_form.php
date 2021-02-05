<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyLimitation */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="company-limitation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Company')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'max_user')->textInput(['placeholder' => 'Max User']) ?>

    <?= $form->field($model, 'max_project')->textInput(['placeholder' => 'Max Project']) ?>

    <?= $form->field($model, 'max_unrestricted_project')->textInput(['placeholder' => 'Max Unrestricted Project']) ?>

    <?= $form->field($model, 'max_grade')->textInput(['placeholder' => 'Max Grade']) ?>

    <?= $form->field($model, 'max_subscription_time')->textInput(['placeholder' => 'Max Subscription Time']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
