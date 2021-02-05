<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyLimitation */

$this->title = Yii::t('app', 'Create Company Limitation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Limitation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-limitation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
