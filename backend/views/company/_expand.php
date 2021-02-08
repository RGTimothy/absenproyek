<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company Clock')),
        'content' => $this->render('_dataCompanyClock', [
            'model' => $model,
            'row' => $model->companyClocks,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company Information')),
        'content' => $this->render('_dataCompanyInformation', [
            'model' => $model,
            'row' => $model->companyInformations,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company Limitation')),
        'content' => $this->render('_dataCompanyLimitation', [
            'model' => $model,
            'row' => $model->companyLimitations,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company Project')),
        'content' => $this->render('_dataCompanyProject', [
            'model' => $model,
            'row' => $model->companyProjects,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Company Role')),
        'content' => $this->render('_dataCompanyRole', [
            'model' => $model,
            'row' => $model->companyRoles,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'User')),
        'content' => $this->render('_dataUser', [
            'model' => $model,
            'row' => $model->users,
        ]),
    ],
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
