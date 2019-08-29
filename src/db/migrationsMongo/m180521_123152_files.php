<?php

namespace backend\db\migrationsMongo;

use yii\mongodb\Migration;

class m180521_123152_files extends Migration
{
    private $collection = 'files';
 
    public function up()
    {
        $this->createCollection($this->collection);
        $this->createIndex($this->collection, 'name');
        $this->createIndex($this->collection, 'path');
        $this->createIndex($this->collection, 'type');
        $this->createIndex($this->collection, 'createdAt');
    }
 
    public function down()
    {
        $this->dropIndex($this->collection, 'createdAt');
        $this->dropIndex($this->collection, 'type');
        $this->dropIndex($this->collection, 'path');
        $this->dropIndex($this->collection, 'name');
        $this->dropCollection($this->collection);
    }
}
