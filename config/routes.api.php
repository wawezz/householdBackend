<?php

$GET = 'GET';
$POST = 'POST,OPTIONS';

return [
    "$POST api/v1/user/login" => 'api/v1/user/login',
    "$POST api/v1/user/logout" => 'api/v1/user/logout',
    "$POST api/v1/user/login-refresh" => 'api/v1/user/login-refresh',
    "$POST api/v1/user/registration" => 'api/v1/user/registration',
    "$POST api/v1/user" => 'api/v1/user/detail',
    "$POST api/v1/user/update" => 'api/v1/user/update',
    "$POST api/v1/user/list" => 'api/v1/user/list',
    "$POST api/v1/houses/list" => 'api/v1/houses/list',
    "$POST api/v1/houses/get" => 'api/v1/houses/get',
    "$POST api/v1/houses/add" => 'api/v1/houses/add',
    "$POST api/v1/houses/remove" => 'api/v1/houses/remove',
    "$POST api/v1/houses/update" => 'api/v1/houses/update',
    "$POST  api/v1" => 'api/v1/index',
];
