<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->username) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        [
            'attribute' => 'company.name',
            'label' => Yii::t('app', 'Company'),
        ],
        'company_role',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'phone',
        'status',
        'verification_token',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>