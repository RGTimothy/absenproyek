<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyRole */

?>
<div class="company-role-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->code) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        [
            'attribute' => 'company.name',
            'label' => Yii::t('app', 'Company'),
        ],
        'description:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>