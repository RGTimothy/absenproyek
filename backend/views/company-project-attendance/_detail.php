<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendance */

?>
<div class="company-project-attendance-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->user->username) . ' (' . $model->created_at . ')' ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'user.phone',
            'label' => Yii::t('app', 'Phone'),
        ],
        [
            'attribute' => 'user.email',
            'label' => Yii::t('app', 'Email'),
        ],
        [
            'attribute' => 'companyProject.name',
            'label' => Yii::t('app', 'Company Project'),
        ],
        'latitude',
        'longitude',
        'status',
        [
            'attribute'=>'image',
            'format' => 'raw',
            'value' => '<img src="data:image/jpeg;base64,' . base64_encode($model->image) . '">',
        ],
        // 'remark:ntext',
        // 'image',
        // 'image_filename',
        // 'image_filetype',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>