<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendance */

$this->title = Yii::t('app', 'Create Company Project Attendance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendance'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
