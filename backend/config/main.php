<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'layout' => 'left-menu', // defaults to null, using the application's layout without the menu
                                     // other available values are 'right-menu' and 'top-menu'
            'mainLayout' => '@app/views/layouts/main.php',
            /*'menus' => [
                'assignment' => [
                    'label' => 'Grant Access' // change label
                ],
                'route' => null, // disable menu
            ],*/
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                     // 'userClassName' => 'app\models\User', 
                    'idField' => 'id',
                    'usernameField' => 'username',
                    // 'fullnameField' => 'profile.full_name',
                    /*'extraColumns' => [
                        [
                            'attribute' => 'full_name',
                            'label' => 'Full Name',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->full_name;
                            },
                        ],
                        [
                            'attribute' => 'dept_name',
                            'label' => 'Department',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->dept->name;
                            },
                        ],
                        [
                            'attribute' => 'post_name',
                            'label' => 'Post',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->post->name;
                            },
                        ],
                    ],*/
                    // 'searchClass' => 'app\models\UserSearch'
                ],
                /*'other' => [
                    'class' => 'path\to\OtherController', // add another controller
                ],*/
            ],
        ],
    ],
    'components' => [
        'authManager' => [
            'defaultRoles' => ['Guest'],
            'class' => 'yii\rbac\DbManager', // use 'yii\rbac\DbManager' or 'yii\rbac\PhpManager'
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            // 'identityClass' => 'mdm\admin\models\User',
            'identityClass' => 'backend\models\User',
            // 'loginUrl' => ['admin/user/login'],
            'loginUrl' => ['site/login'],
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            // 'site/*',
            'admin/*',
            'gii/*',
            'user/*',
            'company/*',
            'company-clock/*',
            'company-information/*',
            'company-project/*',
            'company-project-attendance/*',
            // 'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ],
    ],
    'params' => $params,
];
