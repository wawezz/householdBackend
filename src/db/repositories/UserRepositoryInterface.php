<?php

namespace backend\db\repositories;

use backend\db\models\User;

interface UserRepositoryInterface
{
    /**
     * @param array|null $query
     * @param array|null $fields
     * @param array|null $options
     * @return array
     */
    public function findAll(array $query = array(), array $fields = array(), array $options = array()): array;

    /**
     * @param array|null $query
     * @return int
     */
    public function countAll(array $query = array()): int;

    /**
     * @param string $id
     * @return \backend\db\models\User|null
     */
    public function findById(string $id): ?User;

    /**
     * @param string $email
     * @return \backend\db\models\User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param User $user
     * @return bool
     */
    public function insert(User $user): bool;

    /**
     * @param array|null $query
     * @param array|null $options
     * @return bool
     */
    public function deleteAll(array $query = array(), array $options = array()): bool;
}
