<?php

use backend\common\mailer\Mailer;

return [
    'class' => Mailer::class,
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'SMTP_HOST',
        'username' => 'SMTP_USER',
        'password' => 'SMTP_PASSWORD',
        'port' => 'SMTP_PORT',
        'encryption' => 'SMTP_ENCRYPT',
        // 'encryption' => 'ssl',
        'timeout' => 5,
    ],
    'messageConfig' => [
        'from' => ['SMTP_FROM' => 'from'],
        'replyTo' => 'team@replaceHost',
    ],
];
