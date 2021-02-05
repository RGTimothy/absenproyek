<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyLimitationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-company-limitation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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

    <?php /* echo $form->field($model, 'max_grade')->textInput(['placeholder' => 'Max Grade']) */ ?>

    <?php /* echo $form->field($model, 'max_subscription_time')->textInput(['placeholder' => 'Max Subscription Time']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
