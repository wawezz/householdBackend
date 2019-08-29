<?php

namespace backend\db\repositories;

use backend\db\models\File;

interface FileRepositoryInterface
{
    /**
     * @param $id
     * @return array
     */
    public function findById($id): ?array;

    /**
     * @param File $file
     * @return bool
     */
    public function insert(File $file): bool;

    /**
     * @param $users
     * @return bool
     */
    public function removeByUsers($users): bool;

    /**
     * @param $query
     * @param $options
     * @return bool
     */
    public function deleteAll(array $query = array(), array $options = array()): bool;
}
