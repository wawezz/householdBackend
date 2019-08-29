<?php

namespace backend\db\repositories\db;

use backend\db\models\Role;
use yii\mongodb\Connection;

class DbNoteRepository extends AbstractMongoDbRepository
{

    /**
    * @var int
    */
    private $collection;

    public function __construct(Connection $db)
    {
        parent::__construct($db);

        $this->collection = $this->db->getCollection('roles');
    }

    public function findAll(array $query = array(), array $fields = array(), array $options = array()): array
    {
        
        $cursor = $this->collection->find($query, $fields, $options);
 
        return $cursor->toArray();
    }
}
