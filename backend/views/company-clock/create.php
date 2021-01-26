<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyClock */

$this->title = Yii::t('app', 'Create Company Clock');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Clocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-clock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
