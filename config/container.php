<?php

use backend\db\common\Command as AppSqlCommand;
use backend\db\common\generator\UuidGenerator;
use backend\db\common\IdGeneratorInterface;
use backend\db\repositories\db\DbUserRepository; 
use backend\db\repositories\db\DbFileRepository; 
use backend\db\repositories\db\DbHouseRepository; 
use backend\db\repositories\UserRepositoryInterface;
use backend\db\repositories\FileRepositoryInterface;
use backend\db\repositories\HouseRepositoryInterface;
use backend\services\Session;

$container = \Yii::$container;

$container->setDefinitions([
    IdGeneratorInterface::class => UuidGenerator::class,
    UserRepositoryInterface::class => DbUserRepository::class,
    HouseRepositoryInterface::class => DbHouseRepository::class,
    FileRepositoryInterface::class => DbFileRepository::class,
]);