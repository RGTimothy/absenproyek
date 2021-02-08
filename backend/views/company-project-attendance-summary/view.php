<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendanceSummary */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendance Summary'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-attendance-summary-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company Project Attendance Summary').' '. Html::encode($this->title) ?></h2>
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
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'companyRole.id',
            'label' => Yii::t('app', 'Company Role'),
        ],
        'projects:ntext',
        'work_duration',
        'overtime_duration_1:datetime',
        'overtime_duration_2:datetime',
        'overtime_duration_3:datetime',
        'total_allowance',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>CompanyRole<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCompanyRole = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        'company_id',
        'is_default',
        'description',
    ];
    echo DetailView::widget([
        'model' => $model->companyRole,
        'attributes' => $gridColumnCompanyRole    ]);
    ?>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'company_id',
        [
            'attribute' => 'companyRole.id',
            'label' => Yii::t('app', 'Company Role'),
        ],
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'phone',
        'status',
        'verification_token',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
</div>
