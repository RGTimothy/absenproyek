<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProject */
/* @var $form yii\widgets\ActiveForm */

/*\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyProjectAttendance', 
        'relID' => 'company-project-attendance', 
        'value' => \yii\helpers\Json::encode($model->companyProjectAttendances),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);*/
?>


<!-- <div id="googleMap" style="width:100%;height:400px;"></div>
<script type="text/javascript">
    function myMap() {
        var mapProp= {
          center:new google.maps.LatLng(-6.1753924,106.8271528),
          zoom:5,
      };
      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe_kJI9IfjxJsNFQCSTudg1Kkr9eWKFKc&callback=myMap&libraries=&v=weekly" defer></script>
</script> -->

<div class="company-project-form">

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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true, 'placeholder' => 'Latitude']) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true, 'placeholder' => 'Longitude']) ?>

    <?= $form->field($model, 'radius')->textInput(['placeholder' => 'Radius']) ?>

    <?php /*$form->field($model, 'clock_in')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Clock In'),
                'autoclose' => true
            ]
        ]
    ]);*/ ?>

    <?php /*$form->field($model, 'clock_out')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Clock Out'),
                'autoclose' => true
            ]
        ]
    ]);*/ ?>

    <?php
    /*$forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyProjectAttendance')),
            'content' => $this->render('_formCompanyProjectAttendance', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyProjectAttendances),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);*/
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
