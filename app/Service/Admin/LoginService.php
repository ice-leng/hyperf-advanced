<?php

namespace App\Service\Admin;

use App\Constant\Errors\AdminError;
use App\Constant\Status\AdminStatus;
use App\Model\Admin;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Auth\IdentityInterface;
use Lengbin\Auth\IdentityRepositoryInterface;
use Lengbin\Helper\Util\PasswordHelper;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\Jwt\JwtInterface;

class LoginService extends BaseService implements IdentityRepositoryInterface
{
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
        return Admin::findOne('admin_id', $id);
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
        $data = $this->jwt->verifyToken($token);
        if (!ArrayHelper::isValidValue($data, 'admin_id')) {
            return null;
        }
        $admin = $this->findIdentity($data['admin_id']);
        $this->checkAdminStatus($admin);
        return $admin;
    }

    /**
     * check status
     * @param $admin
     */
    protected function checkAdminStatus($admin): void
    {
        if (StringHelper::isEmpty($admin) || $admin->status === AdminStatus::FROZEN) {
            throw new BusinessException(AdminError::ERROR_ADMIN_FREEZE);
        }
    }

    /**
     * 登录
     *
     * @param array  $params [account, password]
     * @param string $ip
     *
     * @return array
     */
    public function login(array $params, string $ip): array
    {
        $admin = Admin::findOneCondition([
            'account' => $params['account'],
        ], ['admin_id', 'password', 'status']);

        if (StringHelper::isEmpty($admin)) {
            throw new BusinessException(AdminError::ERROR_ADMIN_ACCOUNT_OR_PASSWORD_FAIL);
        }

        if (!PasswordHelper::verifyPassword($params['password'], $admin->password)) {
            throw new BusinessException(AdminError::ERROR_ADMIN_ACCOUNT_OR_PASSWORD_FAIL);
        }

        $this->checkAdminStatus($admin);

        $token = $this->jwt->generate([
            'admin_id' => $admin->admin_id,
        ]);
        // todo 登录日志
        return [
            'token'         => $token,
            'refresh_token' => $this->jwt->generateRefreshToken($token),
        ];
    }

    /**
     * 刷新token
     *
     * @param string $refreshToken
     * @param string $ip
     *
     * @return array
     */
    public function refreshToken(string $refreshToken, string $ip): array
    {
        // todo 登录日志
        $token = $this->jwt->refreshToken($refreshToken);
        return [
            'token'         => $token,
            'refresh_token' => $refreshToken,
        ];
    }

    /**
     * 退出
     *
     * @param string $token
     * @param string $ip
     *
     * @return bool
     */
    public function logout(string $token, string $ip): bool
    {
        // todo 登录日志
        return $this->jwt->logout($token);
    }
}
