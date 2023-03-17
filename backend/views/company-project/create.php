<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProject */

$this->title = Yii::t('app', 'Tambah Proyek');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyek'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
