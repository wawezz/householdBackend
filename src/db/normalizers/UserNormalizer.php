<?php

namespace backend\db\normalizers;

class UserNormalizer extends BaseNormalizer
{
    /**
     * @param \backend\db\models\User $object
     * @throws \Exception
     */
    public static function normalize($object): void
    {

    }

    /**
     * @param \backend\db\models\User $object
     * @return array
     */
    public static function serialize($object): array
    {
        
        return [ 
            'id' => $object->id,
            'email' => $object->email,
            'name' => $object->name,
            'roleId' => $object->roleId,
            'avatarId' => $object->avatarId,
            'createdAt' => $object->createdAt,
            'passwordHash' => $object->passwordHash,
            'secret' => $object->secret
        ];
    }
}
