<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'sisbio',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sisbio',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'user' => [
            'identityClass' => 'app\models\Pesquisador',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            // ...
            ],
        ],
        'formatter' => [
            'locale' => 'pt-BR'
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV)
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            // generator name
            'giiant-crud' => [
                //generator class
                'class' => '\schmunk42\giiant\crud\Generator',
                //setting for out templates
                'templates' => [
                    // template name => path to template
                    'Ecoqua' => '@app/giiTemplates/crud/defaultEcoqua',
                ]
            ],
            'giiant-model' => [
                //generator class
                'class' => '\schmunk42\giiant\model\Generator',
                //setting for out templates
                'templates' => [
                    // template name => path to template
                    'Ecoqua' => '@app/giiTemplates/model/defaultEcoqua',
                ]
            ]
        ],
    ];
}

return $config;
