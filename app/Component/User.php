<?php

namespace App\Component;

use App\Service\Admin\AdminLoginService;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Auth\IdentityInterface;
use Lengbin\Auth\IdentityRepositoryInterface;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Jwt\JwtInterface;

class User implements IdentityRepositoryInterface
{

    /**
     * @Inject()
     * @var AdminLoginService
     */
    protected $adminLoginService;

    /**
     * @Inject()
     * @var JwtInterface
     */
    protected $jwt;

    /**
     * @param string $id
     *
     * @return IdentityInterface|null
     */
    public function findIdentity(string $id): ?IdentityInterface
    {
        // session
        return null;
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @param string $type  the type of the token. The value of this parameter depends on the implementation and should
     *                      allow supporting multiple token types for a single identity.
     *
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public function findIdentityByToken(string $token, string $type): ?IdentityInterface
    {
        $user = null;
        $data = $this->jwt->verifyToken($token);
        $channel = ArrayHelper::get($data, 'channel', null);
        // 多服务器 渠道 判断
        switch ($channel) {
            case 'admin':
                if (ArrayHelper::isValidValue($data, 'admin_id')) {
                    $user = $this->adminLoginService->findIdentity(['admin_id' => $data['admin_id']]);
                }
                break;
        }
        return $user;
    }
}
