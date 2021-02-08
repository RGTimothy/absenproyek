<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Karyawan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Karyawan').': '. Html::encode($this->title) ?></h2>
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
            
            <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        'username',
        [
            'attribute' => 'company.name',
            'label' => Yii::t('app', 'Perusahaan'),
        ],
        [
            'attribute' => 'companyRole.code',
            'label' => Yii::t('app', 'Grade'),
        ],
        // 'auth_key',
        // 'password_hash',
        // 'password_reset_token',
        'email:email',
        'phone',
        // 'status',
        // 'verification_token',
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
                'label' => Yii::t('app', 'Proyek')
            ],
            'latitude',
            'longitude',
            'status',
            [
                'attribute' => 'created_at',
                'label' => 'Waktu',
            ],
            // 'image',
            // 'image_filename',
            // 'image_filetype',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCompanyProjectAttendance,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-project-attendance']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Absensi')),
        ],
        'columns' => $gridColumnCompanyProjectAttendance
    ]);
}
?>

    </div>
    <!-- <div class="row">
        <h4>Company<?php  //' '. Html::encode($this->title) ?></h4>
    </div> -->
    <?php 
    /*$gridColumnCompany = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
        'image_filename',
        'description',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->company,
        'attributes' => $gridColumnCompany    ]);*/
    ?>
    <!-- <div class="row">
        <h4>CompanyRole<?php //' '. Html::encode($this->title) ?></h4>
    </div> -->
    <?php 
    /*$gridColumnCompanyRole = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        'description',
    ];
    echo DetailView::widget([
        'model' => $model->companyRole,
        'attributes' => $gridColumnCompanyRole    ]);*/
    ?>
</div>
