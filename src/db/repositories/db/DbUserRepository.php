<?php

namespace backend\db\repositories\db;

use backend\db\common\generator\SecretGenerator;
use backend\db\models\User;
use backend\db\normalizers\UserNormalizer;
use backend\db\repositories\UserRepositoryInterface;
use yii\mongodb\Connection;

class DbUserRepository extends AbstractDbRepository implements UserRepositoryInterface
{

    /**
     * @var \backend\db\common\generator\SecretGenerator
     */
    private $collection;
    private $secretGenerator;

    public function __construct(Connection $db, SecretGenerator $secretGenerator)
    {
        parent::__construct($db);

        $this->secretGenerator = $secretGenerator;
        $this->collection = $this->db->getCollection('users');
    }

    public function findAll(array $query = array(), array $fields = array(), array $options = array()): array
    {
        $cursor = $this->collection->find($query, $fields, $options);
 
        return $cursor->toArray();
    }

    public function countAll($query = array()): int
    {
        return $this->collection->count($query);
    }

    public function findById(string $id): ?User
    {
        if (mb_strlen($id) > 36 && preg_match('/-([a-f0-9]+)$/i', $id, $m)) {
            $secret = $m[1];
            $id = str_replace("-$secret", '', $id);
        } else {
            $secret = null;
        }

        $query = array();

        if($id) $query['_id'] = $id;

        if ($secret !== null) {
            $query['secret'] = $secret;
        }

        $result = $this->collection->findOne($query)->toArray();

        return $result;
    }

    public function findByEmail(string $email): ?User
    {
        $query = array();

        if($email) $query['email'] = $email;

        $result = $this->collection->findOne($query)->toArray();

        return $result;
    }

    public function insert(User $user): bool
    {

        if (empty($user->secret)) {
            $user->secret = $this->secretGenerator->generate();
        }

        if (!empty($user->password)) {
            $user->passwordHash = \Yii::$app->security->generatePasswordHash($user->password);
        }

        $this->collection->insert($user->publicBundle());

        return true;
    }

    public function deleteAll(array $query = array(), array $options = array()): bool
    {
        return $this->collection->remove($query, $options);
    }
}
