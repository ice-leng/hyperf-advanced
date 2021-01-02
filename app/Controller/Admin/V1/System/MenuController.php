<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\MenuService;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\PostApi;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Common\Entity\PageEntity;

/**
 * Class MenuController
 * @package App\Controller\Admin\V1\System
 *
 * @ApiController(tag="菜单", description="菜单管理")
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
     *     "pageSize|页数":"int|min:1"
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

    public function create()
    {
        $params = $this->getValidateData();
        $this->menuService->create($params);
        return $this->success([]);
    }

    public function update()
    {
        $params = $this->getValidateData();
        $this->menuService->update($params);
        return $this->success([]);
    }

    public function detail()
    {
        $params = $this->getValidateData();
        $this->menuService->detail($params);
        return $this->success([]);
    }

    public function remove()
    {
        $params = $this->getValidateData();
        $this->menuService->remove($params);
        return $this->success([]);
    }
}
