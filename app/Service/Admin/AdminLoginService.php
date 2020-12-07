<?php

namespace App\Service\Admin;

use App\Constant\Errors\AdminError;
use App\Constant\Status\AdminStatus;
use App\Model\Admin;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Auth\IdentityInterface;
use Lengbin\Helper\Util\PasswordHelper;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\Jwt\JwtInterface;

class AdminLoginService extends BaseService
{

    /**
     * @Inject()
     * @var JwtInterface
     */
    protected $jwt;

    /**
     * check status
     *
     * @param Admin|null $admin
     */
    protected function checkAdminStatus($admin): void
    {
        if (StringHelper::isEmpty($admin) || $admin->status === AdminStatus::FROZEN) {
            throw new BusinessException(AdminError::ERROR_ADMIN_FREEZE);
        }
    }

    /**
     * @param array $params
     *
     * @return Admin|null
     */
    public function findIdentity(array $params): ?IdentityInterface
    {
        $admin = Admin::findOneCondition($params);
        $this->checkAdminStatus($admin);
        return $admin;
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
            'channel'  => 'admin',
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
