<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
        'v2' => [
            'basePath' => '@app/modules/v2',
            'class' => 'api\modules\v2\Module'
        ]
    ],
    'components' => [
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if (!$response->isSuccessful) {
                    $errorMessage = '';
                    if (isset($response->data['message'])) {
                        $errorCode = Yii::$app->response->statusCode;
                        
                        //override http response status code
                        Yii::$app->response->statusCode = 200;

                        $errorMessage = $response->data['message'];
                        $response->data = [
                            'hasErrors' => true,
                            'errorCode' => $errorCode,
                            'message' => $errorMessage,
                        ];
                    }
                }
                /*if ($response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }*/
            },
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'enableSession' => false,
            'identityClass' => 'api\modules\v2\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v1/user',
                    'extraPatterns' => [
                        'GET ping' => 'ping',
                        'POST register' => 'register',
                        'POST login' => 'login',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v1/company-information',
                    'extraPatterns' => [
                        'GET list' => 'list',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v1/company-project-attendance',
                    'extraPatterns' => [
                        'GET status' => 'status',
                        'POST clock-in' => 'clock-in',
                        'POST clock-out' => 'clock-out',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v1/company-project',
                    'extraPatterns' => [
                        'GET list' => 'list',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],

                //api version 2.0
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v2/user',
                    'extraPatterns' => [
                        'GET ping' => 'ping',
                        'POST register' => 'register',
                        'POST login' => 'login',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v2/company-information',
                    'extraPatterns' => [
                        'GET list' => 'list',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v2/company-project-attendance',
                    'extraPatterns' => [
                        'GET status' => 'status',
                        'POST clock-in' => 'clock-in',
                        'POST clock-out' => 'clock-out',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => 'v2/company-project',
                    'extraPatterns' => [
                        'GET list' => 'list',
                        'POST list' => 'list',
                    ],
                    'tokens' => [
                        // '{id}' => '<id:\\w+>',
                    ]
                ],
            ],        
        ]
    ],
    'params' => $params,
];



