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
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    /*$gridColumn = [
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-clock']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Company Clock')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-information']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Company Information')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-limitation']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Company Limitation')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-project']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Company Project')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-role']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Company Role')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User')),
        ],
        'columns' => $gridColumnUser
    ]);
}*/
?>

    </div>
</div>
