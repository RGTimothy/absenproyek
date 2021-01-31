<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyRole */

$this->title = Yii::t('app', 'Create Company Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
