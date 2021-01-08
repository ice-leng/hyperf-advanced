<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\RoleService;
use Hyperf\Apidog\Annotation\Header;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\PostApi;
use Lengbin\Hyperf\Common\Entity\PageEntity;

/**
 * Class RoleController
 * @package App\Controller\Admin\V1\System
 *
 * @ApiController(tag="角色", description="角色管理")
 * @Header(key="Token|token", rule="required|string")
 */
class RoleController extends Controller
{
    /**
     * @Inject()
     * @var RoleService
     */
    protected $roleService;

    /**
     * @PostApi(path="/admin/v1/role/list", summary="角色列表", description="角色列表")
     * @Body(rules={
     *     "page|页":"int|min:1",
     *     "pageSize|页数":"int|min:1",
     *     "isAll|是否获取全部":"int"
     * })
     * @ApiResponse(code="0", template="page")
     */
    public function list()
    {
        $params = $this->getValidateData();
        $page = empty($params['isAll']) ? new PageEntity($params) : null;
        $data = $this->roleService->getList($params, [], $page);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/role/create", summary="角色创建", description="角色创建")
     * @Body(rules={
     *     "name|角色名称":"required|string|max:64",
     *     "description|描述":"string",
     *     "permission.*|权限":"required|string|max:64",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function create()
    {
        $params = $this->getValidateData();
        $this->roleService->create($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/role/update", summary="角色更新", description="角色更新")
     * @Body(rules={
     *     "name|角色名称":"required|string|max:64",
     *     "description|描述":"string",
     *     "permission.*|权限":"required|string|max:64",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function update()
    {
        $params = $this->getValidateData();
        $this->roleService->update($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/role/detail", summary="角色详情", description="角色详情")
     * @Body(rules={
     *     "name|角色名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function detail()
    {
        $params = $this->getValidateData();
        $data = $this->roleService->detail($params);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/role/remove", summary="角色移除", description="角色移除")
     * @Body(rules={
     *     "name|角色名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function remove()
    {
        $params = $this->getValidateData();
        $this->roleService->remove($params);
        return $this->success([]);
    }
}
