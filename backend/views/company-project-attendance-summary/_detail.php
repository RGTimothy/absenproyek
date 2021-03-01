<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use \backend\models\CompanyClock;

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
    $companyClockTime = CompanyClock::find()->all();

    $mainWorkingTimeDuration = 0;
    $mainWorkingTimeStart = 0;
    $mainWorkingTimeStop = 0;
    $currentTime = time();
    foreach ($companyClockTime as $item) {
        if ($item->is_default) {
            $mainWorkingTimeStart = strtotime($item->clock_in);
            $mainWorkingTimeStop = strtotime($item->clock_out);
            $mainWorkingTimeDuration = round(abs($mainWorkingTimeStop - $mainWorkingTimeStart) / 60); //in minute
            $mainWorkingTimeDuration = round($mainWorkingTimeDuration / 60); //now in hour
        }
    }

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
        // 'work_duration',
        [
            'attribute' => 'work_duration',
            'value' => function ($model) use ($currentTime, $mainWorkingTimeDuration) {
                if ($model->work_duration == 0) {
                    if ($currentTime > $mainWorkingTimeStop) {
                        return $mainWorkingTimeDuration;
                    }
                }

                return $model->work_duration;
            }
        ],
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