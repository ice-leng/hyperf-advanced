<?php

namespace App\Controller;

use App\Component\AntDesign\Constant\Type\FormDateType;
use App\Component\AntDesign\Constant\Type\ValueType;
use App\Component\AntDesign\Table;
use App\Constant\Status\AdminStatus;
use App\Service\Admin\AdminService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;
use Lengbin\Hyperf\Common\Constant\SoftDeleted;
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
            'column'       => [
                [
                    'dataIndex' => 'admin_id',
                    'title'     => 'id',
                    'valueType' => ValueType::INDEX,
                ],
                [
                    'dataIndex' => 'nickname',
                    'title'     => '昵称',
                    'valueType' => ValueType::TEXT,
                ],
                [
                    'dataIndex' => 'password',
                    'title'     => '密码',
                    'valueType' => ValueType::PASSWORD,
                ],
                [
                    'dataIndex' => 'number',
                    'title'     => '工号',
                    'valueType' => ValueType::MONEY,
                ],
                [
                    'dataIndex' => 'status',
                    'title'     => '状态',
                    'valueType' => ValueType::SELECT,
                    'valueEnum' => AdminStatus::getMapJson(),
                ],
                [
                    'dataIndex' => 'enable',
                    'title'     => '是否停用',
                    'valueType' => ValueType::RADIO,
                    'valueEnum' => SoftDeleted::getMapJson(),
                ],
                [
                    'dataIndex' => 'create_at',
                    'title'     => '创建时间',
                    'valueType' => ValueType::DATE_TIME,
                ],
                [
                    'dataIndex' => '',
                    'title'     => '操作',
                    'valueType' => ValueType::OPTION,
                ],
            ],
            'columnConfig' => [
                'rowKey'     => 'admin_id',
                'pagination' => ['pageSize' => 2],
            ],
            'pageConfig'   => [
                'submitText' => '提交',
            ],
            'form'         => [
                [
                    'title' => '基础信息',
                    'item'  => [
                        [
                            'inputType' => 'text',
                            'name'      => 'nickname',
                            'label'     => '昵称',
                        ],
                        [
                            'inputType' => 'password',
                            'name'      => 'password',
                            'label'     => '密码',
                        ],
                        [
                            'inputType' => 'checkbox',
                            'name'      => 'number',
                            'label'     => '工号',
                            'valueEnum' => AdminStatus::getMapJson(),
                        ],
                        [
                            'inputType' => 'select',
                            'name'      => 'status',
                            'label'     => '状态',
                            'valueEnum' => AdminStatus::getMapJson(),
                        ],
                        [
                            'inputType'         => 'switch',
                            'name'              => 'enable',
                            'label'             => '是否停用',
                            'checkedChildren'   => '左',
                            'unCheckedChildren' => '右',
                            'valueEnum'         => SoftDeleted::getMapJson(),
                        ],
                        [
                            'inputType' => 'date',
                            'name'      => 'create_at',
                            'label'     => '创建时间',
                            'type'      => FormDateType::DATE_TIME,
                        ],
                    ],
                ],
                [
                    'title' => '额外',
                    'item'  => [
                        [
                            'inputType' => 'slider',
                            'name'      => 'slider',
                            'label'     => '百分比',
                            'min'       => 0,
                            'max'       => 100,
                        ],
                        [
                            'inputType' => 'rate',
                            'name'      => 'rate',
                            'label'     => '分',
                            'allowHalf' => true,
                            'count'     => 6,
                        ],
                    ],
                ],
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
