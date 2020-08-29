<?php

namespace App\Model;

use Lengbin\Auth\IdentityInterface;
use Lengbin\Auth\IdentityRepositoryInterface;
use Lengbin\Hyperf\Common\Framework\BaseModel;

class UserModel extends BaseModel implements IdentityRepositoryInterface, IdentityInterface
{

    public function findIdentity(string $id): ?IdentityInterface
    {

    }

    public function findIdentityByToken(string $token, string $type): ?IdentityInterface
    {
        var_dump($token, $type);
        return $this;
    }

    public function getId()
    {
        return '1234';
    }
}
