<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\PermissionService;
use Hyperf\Di\Annotation\Inject;

class PermissionController extends Controller
{
    /**
     * @Inject()
     * @var PermissionService
     */
    protected $permissionService;

    public function list()
    {
        $params = $this->getValidateData();
        $data = $this->permissionService->getList($params);
        return $this->success($data);
    }

    public function create()
    {
        $params = $this->getValidateData();
        $this->permissionService->create($params);
        return $this->success([]);
    }

    public function update()
    {
        $params = $this->getValidateData();
        $this->permissionService->update($params);
        return $this->success([]);
    }

    public function detail()
    {
        $params = $this->getValidateData();
        $this->permissionService->detail($params);
        return $this->success([]);
    }

    public function remove()
    {
        $params = $this->getValidateData();
        $this->permissionService->remove($params);
        return $this->success([]);
    }
}
