<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Karyawan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a(Yii::t('app', 'Tambah Karyawan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        $userID = Yii::$app->user->id;
        $dataUser = User::findIdentity($userID);
        $companyID = isset($dataUser->company->id) ? $dataUser->company->id : null;

        if (!is_null($companyID)) {
            $dataProvider = new ActiveDataProvider([
                'query' => User::find()->where(['company_id' => $companyID])->andWhere(['company_role' => User::COMPANY_ROLE_WORKER]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        }
        // echo $dataUser->company->id;
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            // 'company_id',
            [
                'label' => 'Nama Perusahaan',
                'value' => function ($model) {
                    return $model->company->name;
                }
            ],
            // 'auth_key',
            // 'password_hash',
            //'password_reset_token',
            //'email:email',
            'phone',
            //'status',
            // 'created_at',
            [
                'attribute' => 'Tanggal Daftar',
                'value' => 'created_at',
            ],
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
