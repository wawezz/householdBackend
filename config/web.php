<?php

use backend\common\log\SentryTarget;
use yii\caching\ApcCache;
use yii\caching\ArrayCache;
use backend\common\web\UserAccessChecker;
use backend\db\models\User;
use backend\services\Session\Session;
use yii\web\CacheSession;
use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'viewPath' => dirname(__DIR__) . '/src/views',
    'aliases' => require __DIR__ . '/aliases.php',
    'controllerNamespace' => 'backend\\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'mongodb' => require __DIR__ . '/mongo.php',
        'mailer' => require __DIR__ . '/mailer.php',
        'request' => [
            // 'baseUrl' => '/api',
            'cookieValidationKey' => 'oZKF8xgWoLw15D6WBMSLxJlJ4WJgH0dH',
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'cache' => [
            'class' => ArrayCache::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => SentryTarget::class,
                    'dsn' => getenv('SENTRY_DSN'),
                    'levels' => ['error', 'warning'],
                    'context' => true,
                ],
            ],
        ],
        'assetManager' => [ 
            'linkAssets' => true,
            //'baseUrl' => '/admin/assets',
        ],
        'urlManager' => [
            //'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array_merge(
                require __DIR__ . '/routes.api.php'
            ),
        ],
        'user' => [
            'identityClass' => User::class, 
            //'loginUrl' => '/admin/login',
            'accessChecker' => UserAccessChecker::class,
        ],
        'session' => [
            'class' => 'yii\mongodb\Session',
            'db' => 'session',
            // 'sessionCollection' => 'my_session',
        ],
        'cache.apc' => [
            'class' => ApcCache::class,
            'useApcu' => true,
        ],
    ],
    'params' => $params,
];

// if (YII_DEBUG) {
// configuration adjustments for 'dev' environment
$config['bootstrap'][] = 'debug';
$config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['*'],
    'historySize' => 500,
];

// }

return $config;
