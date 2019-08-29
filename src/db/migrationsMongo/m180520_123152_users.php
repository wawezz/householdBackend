<?php

namespace backend\db\migrationsMongo;

use yii\mongodb\Migration;

class m180520_123152_users extends Migration
{
    private $collection = 'users';
 
    public function up()
    {
        $this->createCollection($this->collection);
        $this->createIndex($this->collection, 'email');
        $this->createIndex($this->collection, 'name');
        $this->createIndex($this->collection, 'roleId');
        $this->createIndex($this->collection, 'avatarId');
        $this->createIndex($this->collection, 'avatarPath');
        $this->createIndex($this->collection, 'createdAt');
        $this->createIndex($this->collection, 'passwordHash');
        $this->createIndex($this->collection, 'secret');
    }
 
    public function down()
    {
        $this->dropIndex($this->collection, 'secret');
        $this->dropIndex($this->collection, 'passwordHash');
        $this->dropIndex($this->collection, 'createdAt');
        $this->dropIndex($this->collection, 'avatarPath');
        $this->dropIndex($this->collection, 'avatarId');
        $this->dropIndex($this->collection, 'roleId');
        $this->dropIndex($this->collection, 'name');
        $this->dropIndex($this->collection, 'email');
        $this->dropCollection($this->collection);
    }
}