<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Absensi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$username = $model->user->username;
$time = $model->created_at;
?>
<div class="company-project-attendance-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Absensi').': '. Html::encode($username) . ' (' . $time . ')' ?></h2>
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
            
            <?php //Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php /*Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])*/
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
            'attribute' => 'companyProject.name',
            'label' => Yii::t('app', 'Company Project'),
        ],
        'latitude',
        'longitude',
        'status',
        [
            'attribute' => 'created_at',
            'label' => 'Time',
        ],
        // 'remark:ntext',
        // 'image',
        [
            'attribute'=>'image',
            'format' => 'raw',
            // 'value' => 'data:image/jpeg;base64,' . base64_encode($model->image),
        ],
        // 'image_filename',
        // 'image_filetype',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <!-- <div class="row">
        <h4>CompanyProject<?php  //' '. Html::encode($this->title) ?></h4>
    </div> -->
    <?php 
    /*$gridColumnCompanyProject = [
        ['attribute' => 'id', 'visible' => false],
        'company_id',
        'name',
        'description',
        'latitude',
        'longitude',
        'radius',
        'clock_in',
        'clock_out',
    ];
    echo DetailView::widget([
        'model' => $model->companyProject,
        'attributes' => $gridColumnCompanyProject    ]);*/
    ?>
    <!-- <div class="row">
        <h4>User<?php //' '. Html::encode($this->title) ?></h4>
    </div> -->
    <?php 
    /*$gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'company_id',
        'company_role_id',
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
        'attributes' => $gridColumnUser    ]);*/
    ?>
</div>
