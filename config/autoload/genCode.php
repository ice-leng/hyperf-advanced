<?php

return [
    'default'    => [
        'controller' => [
            'path' => 'app/Controller',
        ],
        'service'    => [
            'path' => 'app/Service',
        ],
        'errorCode'  => [
            'path'   => 'app/Constant/Errors',
        ],
        // 操作 默认选项配置
        'actions'    => [
            [
                'name'   => '删除',
                'type'   => 'action',
                'target' => 'button',
                'path'   => 'remove',
                'tip'    => '您确定删除吗？',
            ],
            [
                'name'   => '创建',
                'type'   => 'action',
                'target' => 'button',
                'path'   => 'create',
                'form'   => [],
            ],
            [
                'name'   => '导入',
                'type'   => 'action',
                'target' => 'button',
                'path'   => 'import',
            ],
            [
                'name'   => '导出',
                'type'   => 'action',
                'target' => 'button',
                'path'   => 'export',
            ],
            [
                'name'   => '冻结',
                'type'   => 'action',
                'target' => 'button',
                'path'   => 'changeStatus',
                'data'   => [
                    'status' => 2,
                ],
            ],
            [
                'name'   => '编辑',
                'label'  => '行内编辑',
                'type'   => 'operation',
                'target' => 'link',
                'path'   => 'detail',
                'form'   => [],
            ],
            [
                'name'   => '删除',
                'label'  => '行内删除',
                'type'   => 'operation',
                'target' => 'link',
                'path'   => 'remove',
                'tip'    => '您确定删除吗？',
            ],
            [
                'name'      => '修改状态',
                'type'      => 'operation',
                'target'    => 'link',
                'path'      => 'changeStatus',
                'form'      => [],
                'condition' => [
                    [
                        'judge' => [
                            [
                                'attribute' => 'status',
                                'type'      => '=',
                                'value'     => 1,
                            ],
                        ],
                        'type'  => 'and',
                        'label' => '冻结',
                    ],
                    [
                        'judge' => [
                            [
                                'attribute' => 'status',
                                'type'      => '=',
                                'value'     => 2,
                            ],
                        ],
                        'type'  => 'and',
                        'label' => '解冻',
                    ],
                ],
            ],
        ],
    ],
    //控制器 继承配置
    'controller' => [
        'prefix'=> '/admin',
        'inheritance' => 'Controller',
        'uses'         => [
            'App\Controller\Controller',
            'Hyperf\Apidog\Annotation\ApiController',
            'Hyperf\Apidog\Annotation\Header',
            'Hyperf\Di\Annotation\Inject',
            'Hyperf\Apidog\Annotation\PostApi',
            'Hyperf\Apidog\Annotation\Body',
            'Hyperf\Apidog\Annotation\ApiResponse',
            'Hyperf\Utils\Context'
        ],
        'comment'     => function ($build) {
            $name = $build->getGenerateCodeEntity()->getName();
            return [
                '@ApiController(tag="'.$name.'")',
                '@Header(key="Token|token", rule="required|string")'
            ];
        },
        'properties'  => function ($build) {
            $serviceName = $build->getService()->getClassname();
            $properties[] = [
                "name"     => lcfirst($serviceName),
                'comments' => [
                    '@Inject()',
                    "@var {$serviceName}",
                ],
            ];
            return $properties;
        },
        'annotationValidateParse' => 'App\Component\Generate\Build\Action\Controller\ValidateParse\ApidogValidateParse',
    ],
    'errorCode'  => [
        'inheritance' => 'BaseEnum',
        'use'         => 'Lengbin\Hyperf\ErrorCode\BaseEnum',
        // 错误码 业务码 前缀版本
        'prefix' => [
//                'api'     => 'B-002', // 其他服务应用
//                'admin'   => 'B-001',
            'default' => 'B-001',
        ],
    ],
    'exception'  => [
        'inheritance' => 'BusinessException',
        'use'         => 'Lengbin\Hyperf\Common\Exception\BusinessException',
    ],
    'service'    => [
        'inheritance' => 'BaseService',
        'use'         => 'Lengbin\Hyperf\Common\Framework\BaseService',
    ],
    //  build action config
    // class = （firstNamespace ? firstNamespace : namespace ）. path . suffix
    'action'     => [
        'service'    => [
            'namespace' => '\App\Component\Generate\Build\Action\Service\Hyperf',
            'suffix'    => 'ActionServiceBuild',
//            'firstNamespace'
        ],
        'controller' => [
            'namespace' => '\App\Component\Generate\Build\Action\Controller\Hyperf',
            'suffix'    => 'ActionControllerBuild',
        ],
    ],
];


