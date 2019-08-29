<?php

namespace backend\db\migrationsMongo;

use yii\mongodb\Migration;

class m180522_123152_roles extends Migration
{
    private $collection = 'roles';
 
    public function up()
    {
        $this->createCollection($this->collection);
        $this->createIndex($this->collection, 'roleId');
        $this->createIndex($this->collection, 'name');
    }
 
    public function down()
    {
        $this->dropIndex($this->collection, 'name');
        $this->dropIndex($this->collection, 'roleId');
        $this->dropCollection($this->collection);
    }
}
