<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyClock', 
        'relID' => 'company-clock', 
        'value' => \yii\helpers\Json::encode($model->companyClocks),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyInformation', 
        'relID' => 'company-information', 
        'value' => \yii\helpers\Json::encode($model->companyInformations),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyLimitation', 
        'relID' => 'company-limitation', 
        'value' => \yii\helpers\Json::encode($model->companyLimitations),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyProject', 
        'relID' => 'company-project', 
        'value' => \yii\helpers\Json::encode($model->companyProjects),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'CompanyRole', 
        'relID' => 'company-role', 
        'value' => \yii\helpers\Json::encode($model->companyRoles),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'User', 
        'relID' => 'user', 
        'value' => \yii\helpers\Json::encode($model->users),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>

    <?= $form->field($model, 'image_filename')->textInput(['maxlength' => true, 'placeholder' => 'Image Filename']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hour_rounding')->textInput(['placeholder' => 'Hour Rounding']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Status']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyClock')),
            'content' => $this->render('_formCompanyClock', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyClocks),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyInformation')),
            'content' => $this->render('_formCompanyInformation', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyInformations),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyLimitation')),
            'content' => $this->render('_formCompanyLimitation', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyLimitations),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyProject')),
            'content' => $this->render('_formCompanyProject', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyProjects),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'CompanyRole')),
            'content' => $this->render('_formCompanyRole', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->companyRoles),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'User')),
            'content' => $this->render('_formUser', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->users),
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
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
