<?php

namespace App\Controller\Admin\V1\Admin;

use App\Controller\Controller;
use App\Service\Admin\AdminService;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\Header;
use Hyperf\Apidog\Annotation\PostApi;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Common\Component\Entity\PageEntity;

/**
 * Class AdminController
 * @ApiController(tag="admin", description="admin")
 * @Header(key="Token|token", rule="required|string")
 */
class AdminController extends Controller
{
    /**
     * @Inject()
     * @var AdminService
     */
    protected $adminService;

    /**
     * @PostApi(path="/admin/v1/admin/list", summary="管理员列表", description="管理员列表")
     * @Body(rules={
     *     "page|页":"int|min:1",
     *     "pageSize|页数":"int|min:1",
     *     "status|状态":"int",
     *     "search|查询":"string"
     * })
     * @ApiResponse(code="0", template="page")
     */
    public function list()
    {
        $params = $this->getValidateData();
        $page = new PageEntity($params);
        $data = $this->adminService->getList($params, [
            'admin_id',
            'account',
            'role',
            'nickname',
            'number',
            'status',
        ], $page);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/admin/create", summary="管理员创建", description="管理员创建")
     * @Body(rules={
     *     "account|账号":"required|string|max:32",
     *     "password|密码":"required|string|max:64",
     *     "role|角色":"required|string|max:255",
     *     "nickname|昵称":"required|string|max:32",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function create()
    {
        $params = $this->getValidateData();
        $this->adminService->create($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/admin/update", summary="管理员更新", description="管理员更新")
     * @Body(rules={
     *     "admin_id|id":"required|int",
     *     "password|密码":"string|max:64",
     *     "role|角色":"string|max:255",
     *     "nickname|昵称":"string|max:32",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function update()
    {
        $params = $this->getValidateData();
        $this->adminService->update($params);
        return $this->success([]);
    }

    /**
     * @PostApi(path="/admin/v1/admin/detail", summary="管理员详情", description="管理员详情")
     * @Body(rules={
     *     "admin_id|id":"required|int",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function detail()
    {
        $params = $this->getValidateData();
        $data = $this->adminService->detail($params, [
            'admin_id',
            'account',
            'role',
            'nickname',
            'number',
            'status',
        ]);
        return $this->success($data);
    }

    /**
     * @PostApi(path="/admin/v1/admin/remove", summary="管理员删除", description="管理员删除")
     * @Body(rules={
     *     "admin_id。*x|id":"required|int",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function remove()
    {
        $params = $this->getValidateData();
        $this->adminService->remove($params);
        return $this->success();
    }

    /**
     * @PostApi(path="/admin/v1/admin/changeStatus", summary="管理员修改状态", description="管理员修改状态")
     * @Body(rules={
     *     "admin_id.*|id":"required|int",
     *     "status|状态":"required|int",
     * })
     * @ApiResponse(code="0", template="success")
     */
    public function changeStatus()
    {
        $params = $this->getValidateData();
        $this->adminService->changeStatus($params);
        return $this->success();
    }
}
