<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Tashkent',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],

        'playmobile' => [
                'class' => \rakhmatov\playmobile\components\Connection::class,
                'username' => '',
                'password' => '',
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                '' => 'site/index'
            ],
        ],

    ],
//    'as beforeRequest' => [
//        'class' => 'yii\filters\AccessControl',
//        'rules' => [
//            [
//                'allow' => true,
//                'actions' => ['login'],
//            ],
//            [
//                'allow' => true,
//                'roles' => ['@'],
//            ],
//        ],
//        'denyCallback' => function () {
//            return Yii::$app->response->redirect(['site/login']);
//        },
//    ],

    'params' => $params,
];
