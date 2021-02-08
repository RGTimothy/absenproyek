<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendanceSummary */

$this->title = Yii::t('app', 'Create Company Project Attendance Summary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendance Summary'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-attendance-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
