<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendanceSummary */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Company Project Attendance Summary',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendance Summary'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="company-project-attendance-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
