<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProject */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company Project').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'company.name',
                'label' => Yii::t('app', 'Company')
            ],
        'name',
        'description:ntext',
        'latitude',
        'longitude',
        'radius',
        'clock_in',
        'clock_out',
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
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
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
