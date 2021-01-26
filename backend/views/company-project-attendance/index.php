<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyProjectAttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Absensi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-project-attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a(Yii::t('app', 'Create Company Project Attendance'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            [
                'label' => 'Username',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Phone',
                'value' => function ($model) {
                    return $model->user->phone;
                }
            ],
            // 'company_project_id',
            [
                'label' => 'Nama Proyek',
                'value' => function ($model) {
                    return $model->companyProject->name;
                }
            ],
            'latitude',
            'longitude',
            'status',
            //'image',
            //'image_filename',
            //'image_filetype',
            //'created_at',
            [
                'label' => 'Waktu',
                'value' => function ($model) {
                    return $model->created_at;
                }
            ],
            //'updated_at',
            //'deleted_at',

            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
