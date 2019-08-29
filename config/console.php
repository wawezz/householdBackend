<?php

use notamedia\sentry\SentryTarget;
use yii\caching\ArrayCache;

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'viewPath' => dirname(__DIR__) . '/src/views',
    'aliases' => require __DIR__ . '/aliases.php',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\commands',
    'controllerMap' => [
        'mongodb-migrate' => [
            'class' => 'yii\mongodb\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'backend\db\migrationsMongo',
            ],
        ],
    ],
    'components' => [
        'mongodb' => require __DIR__ . '/mongo.php',
        'mailer' => require __DIR__ . '/mailer.php',
        'cache' => [
            'class' => ArrayCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => SentryTarget::class,
                    'dsn' => '',
                    'levels' => ['error', 'warning'],
                    'context' => true,
                ],
            ],
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

return $config;
