<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyInformation */

$this->title = Yii::t('app', 'Tambah Informasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
