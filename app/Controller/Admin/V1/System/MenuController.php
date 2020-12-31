<?php

namespace App\Controller\Admin\V1\System;

use App\Controller\Controller;
use App\Service\System\MenuService;
use Hyperf\Di\Annotation\Inject;

class MenuController extends Controller
{
    /**
     * @Inject()
     * @var MenuService
     */
    protected $menuService;

    public function list()
    {
        $params = $this->getValidateData();
        $data = $this->menuService->getList($params);
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
