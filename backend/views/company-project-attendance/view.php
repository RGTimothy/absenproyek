<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProjectAttendance */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Project Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-project-attendance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'user_id',
            // 'company_project_id',
            'companyProject.name',
            'latitude',
            'longitude',
            'status',
            [
                'label' => 'Waktu',
                'value' => $model->created_at,
            ],
            // 'image',
            [
                'attribute'=>'Photo',
                // 'value' => 'data:image/jpeg;base64,' . $model->image,
                'value' => 'data:image/jpeg;base64,' . base64_encode($model->image),
                'format' => [
                    'image',
                    [
                        'width'=>'100%',
                        'height'=>'100%'
                    ]
                ],
            ],
            // 'image_filename',
            // 'image_filetype',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
        ],
    ]) ?>

</div>
