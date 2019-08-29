<?php

use yii\mongodb\Connection;

return 
[
    'class' => Connection::class,
    'dsn' => "mongodb://@mongo/MONGODB_DATABASE",
    'options' => [
        "username" => 'MONGODB_USERNAME',
        "password" => 'MONGODB_PASSWORD'
    ]
];
