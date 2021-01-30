<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyClock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Clock'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-clock-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company Clock').' '. Html::encode($this->title) ?></h2>
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
        'clock_in',
        'clock_out',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
