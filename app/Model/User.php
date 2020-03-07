<?php

namespace App\Model;

use Hyperf\Di\Annotation\Inject;
use Lengbin\Auth\IdentityInterface;
use Lengbin\Auth\IdentityRepositoryInterface;
use Lengbin\Hyperf\Helper\CodeHelper;
use Lengbin\Hyperf\Helper\Exception\BusinessException;
use Lengbin\Hyperf\YiiDb\ActiveRecord;
use Lengbin\Jwt\TokenInterface;


class User extends ActiveRecord implements IdentityRepositoryInterface, IdentityInterface
{

    /**
     * @Inject()
     * @var TokenInterface
     */
    protected $jwt;

    public $id;

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function findIdentity(string $id): ?IdentityInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findIdentityByToken(string $token, string $type): ?IdentityInterface
    {
        if (!$this->jwt->verify($token)) {
            throw new BusinessException(CodeHelper::TOKEN_INVALID);
        }
        $data = $this->jwt->getParams();
        $this->id = $data['jti'];
        return $this;
    }
}
