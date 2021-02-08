<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyClock */

?>
<div class="company-clock-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'company.name',
            'label' => Yii::t('app', 'Perusahaan'),
        ],
        'name',
        'clock_in',
        'clock_out',
        'break_hour',
        'allowance',
        // 'is_default',
        [
            'attribute' => 'is_default',
            'value' => function ($model) {
                return $model->is_default ? 'Ya' : 'Tidak';
            }
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>