<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendanceSummary */

?>
<div class="company-project-attendance-summary-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
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
</div>