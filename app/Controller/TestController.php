<?php

namespace App\Controller;

use App\Component\AntDesign\Table;
use App\Service\Admin\AdminService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Framework\BaseController;
use Hyperf\HttpServer\Annotation\Controller;

/**
 * Class TestController
 * @package App\Controller
 * @Controller()
 * @RouterAuthAnnotation(isPublic=true)
 */
class TestController extends BaseController
{

    /**
     * @Inject()
     * @var AdminService
     */
    protected $adminService;

    /**
     * @GetMapping(path="/init")
     *
     * @return mixed
     */
    public function init()
    {
        $table = new Table([
            'column' => [
                'admin_id|id',
                'nickname|昵称',
                [],
            ],
        ]);
        return $this->success($table->toArray());
    }

    /**
     * @GetMapping(path="/")
     *
     * @return mixed
     */
    public function list()
    {
        $params = $this->request->inputs(['page', 'pageSize']);
        $page = new PageEntity([
            'page'     => !empty($params['page']) ? (int)$params['page'] : 1,
            'pageSize' => !empty($params['pageSize']) ? (int)$params['pageSize'] : 2,
        ]);
        $list = $this->adminService->getList([], ['admin_id', 'nickname'], $page);
        $data = array_merge($list, $params);
        return $this->success($data);
    }

    /**
     * @PostMapping(path="/create")
     */
    public function create()
    {
        return $this->success($this->request->post());
    }

    /**
     * @PostMapping(path="/update")
     */
    public function update()
    {
        return $this->success($this->request->post());
    }

    /**
     * @PostMapping(path="/remove")
     */
    public function remove()
    {
        return $this->success($this->request->post());
    }
}
