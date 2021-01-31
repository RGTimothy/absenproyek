<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendance'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-attendance-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company Project Attendance').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
        [
                'attribute' => 'companyProject.name',
                'label' => Yii::t('app', 'Company Project')
            ],
        'latitude',
        'longitude',
        'status',
        'remark:ntext',
        'image',
        'image_filename',
        'image_filetype',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
