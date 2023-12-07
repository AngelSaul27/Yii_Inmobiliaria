<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'PRru8ZnTNJN8-gpXH9epU15fm89ePlG7',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
            'dirMode' => 0777,
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'on afterLogin' => function ($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'logout' => 'site/logout',
                'login' => 'site/login',
                'register' => 'site/register',
                'register-agente' => 'site/register-agente',

                'inmueble' => 'site/inmuebles-view',
                'inmueble/<id:\d+>' => 'site/inmueble-view',
                'inmueble/ctg/<id:\d+>' => 'site/inmuebles-categoria',

                'user/citas' => 'cita/user',
                'user/cita/<id:\d+>/register' => 'cita/register',
                'user/cita/<id:\d+>/unsubscribe' => 'cita/unsubscribe',

                'agente/citas' => 'cita/view',
                'agente/cita/<id:\d+>/update' => 'cita/assigned',
                'agente/inmuebles' => 'inmueble/view',
                'agente/inmueble/create' => 'inmueble/create',
                'agente/inmueble/<id:\d+>/edit' => 'inmueble/edit',
                'agente/inmueble/<id:\d+>/delete' => 'inmueble/delete',

                'user-management/carousels' => 'management/carousel-view',
                'user-management/carousel/create' => 'management/carousel-create',
                'user-management/carousel/<id:\d+>/edit' => 'management/carousel-edit',
                'user-management/carousel/<id:\d+>/remove' => 'management/carousel-remove',
            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'on beforeAction' => function (yii\base\ActionEvent $event) {
            },
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
