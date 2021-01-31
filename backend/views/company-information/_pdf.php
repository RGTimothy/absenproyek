<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyInformation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Information'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-information-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Company Information').' '. Html::encode($this->title) ?></h2>
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
        'title',
        'description:ntext',
        'start_time',
        'end_time',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
