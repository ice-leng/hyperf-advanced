<?php

namespace App\Controller\Admin\V1;

use App\Controller\Controller;
use App\Service\Admin\AdminLoginService;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\Header;
use Hyperf\Apidog\Annotation\PostApi;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;

/**
 * Class LoginController
 * @package App\Controller
 *
 * @ApiController(tag="登录", description="登录")
 * @RouterAuthAnnotation(isWhitelist=true)
 *
 */
class LoginController extends Controller
{

    /**
     * @Inject()
     * @var AdminLoginService
     */
    protected $loginService;

    /**
     * @PostApi(path="/admin/v1/login", summary="登录", description="登录")
     * @Body(rules={
     *     "account|账号":"required|string|max:32",
     *     "password|密码":"required|string|max:32"
     * })
     * @ApiResponse(code="0", template="success", schema={
     *     "token" : "123456",
     *     "refresh_token": "123456"
     * })
     */
    public function login()
    {
        $params = $this->getValidateData();
        $data = $this->loginService->login($params, $this->request->getClientIp());
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/login/refreshToken", summary="刷新token", description="刷新token")
     * @Body(rules={
     *     "refresh_token|刷新token" : "required|string"
     *     })
     * @ApiResponse(code="0", template="success", schema={
     *     "token" : "123456",
     *     "refresh_token": "123456"
     * })
     */
    public function refreshToken()
    {
        $refreshToken = ArrayHelper::get($this->getValidateData(), 'refresh_token');
        $data = $this->loginService->refreshToken($refreshToken, $this->request->getClientIp());
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/login/logout", summary="注销", description="退出登录")
     * @Header(key="Token|token", rule="required|string")
     *
     * @ApiResponse(code="0", template="success")
     */
    public function logout()
    {
        $token = ArrayHelper::get($this->getValidateData(), 'Token');
        $this->loginService->logout($token, $this->request->getClientIp());
        return $this->success([]);
    }

}
