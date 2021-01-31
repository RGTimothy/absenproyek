<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyInformation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-information-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Informasi').': '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'company.name',
            'label' => Yii::t('app', 'Company'),
        ],
        'title',
        'description:ntext',
        // 'start_time',
        // 'end_time',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <!-- <div class="row">
        <h4>Company<?php //' '. Html::encode($this->title) ?></h4>
    </div> -->
    <?php 
    /*$gridColumnCompany = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
        'image_filename',
        'description:ntext',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->company,
        'attributes' => $gridColumnCompany    ]);*/
    ?>
</div>
