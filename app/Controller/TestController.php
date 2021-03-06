<?php

namespace App\Controller;

use App\Component\AntDesign\Constant\Type\FormDateType;
use App\Component\AntDesign\Constant\Type\ValueType;
use App\Component\AntDesign\Table;
use App\Constant\Status\AdminStatus;
use App\Entity\GenerateCodeEntity;
use App\Service\Admin\AdminService;
use App\Service\System\GenerateService;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Lengbin\Helper\YiiSoft\VarDumper;
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
     * @Inject()
     * @var GenerateService
     */
    protected $generateService;

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
                    'dataIndex' => '',
                    'title'     => '序号',
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

    /**
     * @GetMapping(path="/generate")
     */
    public function generate()
    {
//        $data = [
//            'namespace'   => 'App\Controller',
//            'classname'   => 'AdminController',
//            'uses'        => [
//                'Hyperf\HttpServer\Annotation\Controller',
//                'Lengbin\Hyperf\Auth\RouterAuthAnnotation',
//                'Lengbin\Hyperf\Common\Framework\BaseController',
//            ],
//            'comments'    => [
//                'Class AdminController',
//                '@package App\Controller',
//                '@Controller()',
//                '@RouterAuthAnnotation(isPublic=true)',
//            ],
//            'inheritance' => 'BaseController',
//            'constants'   => [
//                [
//                    'name'    => 'success',
//                    'default' => 1,
//                ],
//                [
//                    'name'    => 'fail',
//                    'default' => "2",
//
//                ],
//            ],
//            'properties'  => [
//                ["name" => 'abc', 'default' => 1.3],
//                ["name" => 'abc2', 'default' => "hello world"],
//                ["name" => 'abc3', 'default' => true],
//                ["name" => 'abc4'],
//            ],
//            'methods'     => [
//                [
//                    "name"    => 'abc',
//                    'params'  => [
//                        ['name' => 'a', 'type' => 'int', 'default' => 1, 'comment' => '左边'],
//                        ['name' => 'b', 'default' => 2, 'comment' => '中间'],
//                        ['name' => 'c', 'type' => 'int'],
//                        ['name' => 'd', 'comment' => '右边'],
//                    ],
//                    'return'  => 'int',
//                    'content' => '',
//                ],
//            ],
//        ];
//        $generate = new Generate();
//        $generate->setPath(BASE_PATH . '/app/Controller');
//        $config = new ClassConfig($data);
//        $generate->setConfig($config);
//        return $this->success(['a' => $generate->output('php'), 'b' => $config->__toObjectString(), 'c' => $config->__getClassname()]);
//
        $config = $this->container->get(ConfigInterface::class)->get('genCode.default');
        $params = [
            'name'       => '管理员',
            'model'      => 'app/Model/Admin',
            'pool'       => 'default',
            'controller' => 'app/Controller/Test/AdminController',
            'service'    => 'app/Service/Test/AdminService',
            'actions'    => $config['actions'],
            'list'       => [// todo 白名单

            ],
            'search'     => [

            ],
            'tag'        => [

            ],
        ];
        $generateCodeEntity = new GenerateCodeEntity($params);
        $data = $this->generateService->crud($generateCodeEntity);
        return $this->success($data);
    }
}
