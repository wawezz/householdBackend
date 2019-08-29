<?php

namespace backend\db\repositories\db;

use backend\db\models\File;
use yii\mongodb\Connection;

class DbFileRepository extends AbstractMongoDbRepository
{
    /**
    * @var int
    */
    private $collection;

    public function __construct(Connection $db)
    {
        parent::__construct($db);

        $this->collection = $this->db->getCollection('files');
    }

    public function findById(string $id = null): array
    {
        $query = array();

        if($id) $query['_id'] = $id;

        $result = $this->collection->findOne($query)->toArray();

        return $result;
    }

    public function insert(File $file): bool
    {
        $this->collection->insert($file->publicBundle());

        return true;
    }

    public function deleteAll(array $query = array(), array $options = array()): bool
    {
        
        return $this->collection->remove($query, $options);
    }

    public function removeByUsers($users): bool
    {

        // $cmd = $this->db->createCommand('SELECT app_files.id, app_files.path, app_files.name FROM app_users LEFT JOIN app_files ON app_users.avatarId = app_files.id WHERE app_users.id IN ("' . implode('","', $users) . '") AND app_users.avatarId > 0');

        // $id = array();
        // $results = $cmd->queryAll();

        // foreach ($results as $result) {
        //     $id[] = $result['id'];

        //     if (file_exists(\Yii::$app->basePath . "/web" . $result['path'] . $result['name'])) {
        //         unlink(\Yii::$app->basePath . "/web" . $result['path'] . $result['name']);
        //     }
        // }

        // $cmd = $this->db->createCommand()->delete('app_files', ['id' => $id]);

        // return $cmd->execute() > 0;
    }
}