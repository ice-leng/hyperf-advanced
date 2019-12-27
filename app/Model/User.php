<?php

namespace App\Model;

use Common\Exception\BusinessException;
use Common\Helper\CodeHelper;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Auth\IdentityInterface;
use Lengbin\Hyperf\Auth\IdentityRepositoryInterface;
use Lengbin\Jwt\TokenInterface;


class User extends Model implements IdentityRepositoryInterface, IdentityInterface
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
