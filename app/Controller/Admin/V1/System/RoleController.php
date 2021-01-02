<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\Manager\RoleService;
use Hyperf\Di\Annotation\Inject;

class RoleController extends Controller
{
    /**
     * @Inject()
     * @var RoleService
     */
    protected $roleService;

    public function list()
    {
        $params = $this->getValidateData();
        $data = $this->roleService->getList($params);
        return $this->success($data);
    }

    public function create()
    {
        $params = $this->getValidateData();
        $this->roleService->create($params);
        return $this->success([]);
    }

    public function update()
    {
        $params = $this->getValidateData();
        $this->roleService->update($params);
        return $this->success([]);
    }

    public function detail()
    {
        $params = $this->getValidateData();
        $this->roleService->detail($params);
        return $this->success([]);
    }

    public function remove()
    {
        $params = $this->getValidateData();
        $this->roleService->remove($params);
        return $this->success([]);
    }
}
