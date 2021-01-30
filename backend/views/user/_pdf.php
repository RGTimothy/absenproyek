<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'User').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'company_id',
        'company_role',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'phone',
        'status',
        'verification_token',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerCompanyProjectAttendance->totalCount){
    $gridColumnCompanyProjectAttendance = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'companyProject.name',
                'label' => Yii::t('app', 'Company Project')
            ],
        'latitude',
        'longitude',
        'status',
        'image',
        'image_filename',
        'image_filetype',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyProjectAttendance,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Company Project Attendance')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCompanyProjectAttendance
    ]);
}
?>
    </div>
</div>
