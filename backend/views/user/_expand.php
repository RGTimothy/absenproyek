<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Karyawan')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    /*[
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Absensi')),
        'content' => $this->render('_dataCompanyProjectAttendance', [
            'model' => $model,
            'row' => $model->companyProjectAttendances,
        ]),
    ],*/
];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
