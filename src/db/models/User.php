<?php

namespace backend\db\models;

use backend\db\normalizers\UserNormalizer;
use yii\helpers\Json;
use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    use UserIdentityTrait;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $roleId;

    /**
     * @var int
     */
    public $avatarId;

    /**
     * @var string
     */
    public $avatarPath;

    /**
     * @var string
     */
    public $avatarName;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $passwordHash;

    /**
     * @var string
     */
    public $secret;

    /**
     * @var int
     */
    public $createdAt;

    /**
     * @var int
     */
    public $updatedAt;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {

        // Compress properties after pdo hydration
        UserNormalizer::normalize($this);

        if (null === $this->createdAt) {
            $this->createdAt = strtotime("now");
        }

        if (null === $this->updatedAt) {
            $this->updatedAt = strtotime("now");
        }
        
    }

    public function getFullId()
    {
        return $this->id . '-' . $this->secret;
    }

    public function publicBundle(): array
    {

        if(!$this->avatarPath) $this->avatarPath = 'images/avatars/';
        $fullId = $this->getFullId();

        return [ 
            '_id' => $fullId,
            'email' => $this->email,
            'name' => $this->name,
            'avatarId' => $this->avatarId,
            'avatar' => $this->avatarPath.$this->avatarName,
            'roleId' => $this->roleId
        ];
    }

    public function getSecurePhrase($time = null): string
    {
        return hash('sha1', Json::encode([
            'id' => $this->id,
            'secret' => $this->secret,
            'time' => (string)$time,
        ]));
    }

    public function hasRole(string $roleId): bool
    {
        return null !== $this->roleId && ($roleId == $this->roleId);
    }
}
