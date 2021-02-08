<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyProjectAttendanceSummarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

// $this->title = Yii::t('app', 'Company Project Attendance Summary');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="company-project-attendance-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a(Yii::t('app', 'Create Company Project Attendance Summary'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php //Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'user_id',
                'label' => Yii::t('app', 'Karyawan'),
                'value' => function($model){
                    if ($model->user)
                    {return $model->user->username;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\backend\models\User::find()->asArray()->all(), 'id', 'username'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Karyawan', 'id' => 'grid-company-project-attendance-summary-search-user_id']
            ],
        [
                'attribute' => 'company_role_id',
                'label' => Yii::t('app', 'Grade'),
                'value' => function($model){
                    if ($model->companyRole)
                    {return $model->companyRole->code;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\backend\models\CompanyRole::find()->asArray()->all(), 'id', 'code'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Grade', 'id' => 'grid-company-project-attendance-summary-search-company_role_id']
            ],
        'projects:ntext',
        'work_duration',
        'overtime_duration_1',
        'overtime_duration_2',
        'overtime_duration_3',
        [
            'attribute' => 'total_allowance',
            'value' => function ($model) {
                return $model->total_allowance > 0 ? 'Ya' : 'Tidak';
            }
        ],
        //premium clients can see column below:
        // 'total_allowance',
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return date('Y-m-d', strtotime($model->created_at));
            }
        ],
        /*[
            'class' => 'yii\grid\ActionColumn',
        ],*/
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company-project-attendance-summary']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
