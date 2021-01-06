<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\PermissionService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\PostApi;

/**
 * Class PermissionController
 * @package App\Controller\Admin\V1\System
 *
 * @ApiController(tag="权限", description="权限管理")
 */
class PermissionController extends Controller
{
    /**
     * @Inject()
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * @PostApi(path="/admin/v1/permission/list", summary="权限列表", description="权限列表")
     * @ApiResponse(code="0", template="success")
     */
    public function list()
    {
        $data = $this->permissionService->getPermissions();
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/permission/create", summary="权限创建", description="权限创建")
     * @Body(rules={
     *     "name|path":"required|string|max:64",
     *     "description|名称":"required|string",
     *     "node.*|节点":"required|string|max:64",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function create()
    {
        $params = $this->getValidateData();
        $this->permissionService->create($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/permission/update", summary="权限更新", description="权限更新")
     * @Body(rules={
     *     "name|path":"required|string|max:64",
     *     "description|名称":"required|string",
     *     "node.*|节点":"required|string|max:64",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function update()
    {
        $params = $this->getValidateData();
        $this->permissionService->update($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/permission/detail", summary="权限详情", description="权限详情")
     * @Body(rules={
     *     "name|权限名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function detail()
    {
        $params = $this->getValidateData();
        $data = $this->permissionService->detail($params);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/permission/remove", summary="权限移除", description="权限移除")
     * @Body(rules={
     *     "name|权限名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function remove()
    {
        $params = $this->getValidateData();
        $this->permissionService->remove($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/permission/search", summary="权限节点筛选", description="权限节点筛选")
     * @Body(rules={
     *     "name|权限名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function search()
    {
        $params = $this->getValidateData();
        $data = $this->permissionService->search($params['name']);
        return $this->success($data);
    }
}
