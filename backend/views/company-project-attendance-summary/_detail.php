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
            <h2><?= Html::encode($model->user->username . ': ' . date('Y-m-d', strtotime($model->created_at))) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'Karyawan'),
        ],
        [
            'attribute' => 'companyRole.code',
            'label' => Yii::t('app', 'Grade'),
        ],
        'projects:ntext',
        'work_duration',
        'overtime_duration_1',
        'overtime_duration_2',
        'overtime_duration_3',
        [
            'attribute' => 'total_allowance',
            'value' => function ($model) {
                return $model->total_allowance > 0 ? 'Ya' : 'Tidak';
            }
        ],
        // 'total_allowance',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>