<?php

use yii\mongodb\Connection;

return 
[
    'class' => Connection::class,
    'dsn' => "mongodb://localhost/household",
    'options' => [
        "username" => 'dbAdmin',
        "password" => '0301937HoST'
    ]
];
