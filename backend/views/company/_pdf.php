<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
        'image_filename',
        'description:ntext',
        'hour_rounding',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyClock->totalCount){
    $gridColumnCompanyClock = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'name',
        'clock_in',
        'clock_out',
        'break_hour',
        'allowance',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyClock,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Clock')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyClock
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyInformation->totalCount){
    $gridColumnCompanyInformation = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'title',
        'description:ntext',
        'start_time',
        'end_time',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyInformation,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Information')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyInformation
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyLimitation->totalCount){
    $gridColumnCompanyLimitation = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'max_user',
        'max_project',
        'max_unrestricted_project',
        'max_grade',
        'max_subscription_time',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyLimitation,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Limitation')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyLimitation
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyProject->totalCount){
    $gridColumnCompanyProject = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'name',
        'description:ntext',
        'latitude',
        'longitude',
        'radius',
        'clock_in',
        'clock_out',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyProject,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Project')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyProject
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyRole->totalCount){
    $gridColumnCompanyRole = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'code',
                'is_default',
        'description:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyRole,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Role')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyRole
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUser->totalCount){
    $gridColumnUser = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'username',
                [
                'attribute' => 'companyRole.id',
                'label' => Yii::t('app', 'Company Role')
            ],
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'phone',
        'status',
        'verification_token',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUser
    ]);
}
?>
    </div>
</div>
