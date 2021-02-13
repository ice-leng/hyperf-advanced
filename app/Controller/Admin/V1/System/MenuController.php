<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\MenuService;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\Header;
use Hyperf\Apidog\Annotation\PostApi;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Common\Component\Entity\PageEntity;

/**
 * Class MenuController
 * @package App\Controller\Admin\V1\System
 *
 * @ApiController(tag="菜单", description="菜单管理")
 * @Header(key="Token|token", rule="required|string")
 */
class MenuController extends Controller
{
    /**
     * @Inject()
     * @var MenuService
     */
    protected $menuService;

    /**
     * @PostApi(path="/admin/v1/menu/list", summary="菜单列表", description="菜单列表")
     * @Body(rules={
     *     "page|页":"int|min:1",
     *     "pageSize|页数":"int|min:1",
     *     "pid|上一级":"string|max:64"
     * })
     * @ApiResponse(code="0", template="page")
     */
    public function list()
    {
        $params = $this->getValidateData();
        $page = new PageEntity($params);
        $data = $this->menuService->getList($params, [], $page);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/menu/create", summary="菜单创建", description="菜单创建")
     * @Body(rules={
     *     "name|菜单名称":"required|string|max:64",
     *     "pid|上一级":"string|max:64",
     *     "icon|菜单图标":"required|string|max:64",
     *     "path|菜单路由":"string|max:255",
     *     "template|模版":"string|max:64",
     *     "role|角色":"required|string|max:64",
     *     "sort|排序":"required|int",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function create()
    {
        $params = $this->getValidateData();
        $this->menuService->create($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/menu/update", summary="菜单更新", description="菜单更新")
     * @Body(rules={
     *     "name|菜单名称":"required|string|max:64",
     *     "pid|上一级":"string|max:64",
     *     "icon|菜单图标":"required|string|max:64",
     *     "path|菜单路由":"string|max:255",
     *     "template|模版":"string|max:64",
     *     "role|角色":"required|string|max:64",
     *     "sort|排序":"required|int",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function update()
    {
        $params = $this->getValidateData();
        $this->menuService->update($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/menu/detail", summary="菜单详情", description="菜单详情")
     * @Body(rules={
     *     "name|菜单名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function detail()
    {
        $params = $this->getValidateData();
        $data = $this->menuService->detail($params);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/menu/remove", summary="菜单移除", description="菜单移除")
     * @Body(rules={
     *     "name|菜单名称":"required|string|max:64"
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function remove()
    {
        $params = $this->getValidateData();
        $this->menuService->remove($params);
        return $this->success([]);
    }
}
