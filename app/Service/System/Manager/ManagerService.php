<?php

namespace App\Service\System\Manager;

use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\YiiSoft\Rbac\ManagerInterface;

class ManagerService extends BaseService
{
    /**
     * @Inject()
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param array      $params
     * @param PageEntity $pageEntity
     *
     * @return array
     */
    public function pageByArray(array $params, PageEntity $pageEntity): array
    {
        $total = count($params);
        $pageSize = $pageEntity->getPageSize();
        $offset = ($pageEntity->getPage() - 1) * $pageSize;
        $params = array_values($params);
        $list = array_slice($params, $offset, $pageSize);
        return [
            'list'      => $list,
            'pageSize'  => $pageSize,
            'total'     => $total,
            'totalPage' => ceil($total / $pageSize),
        ];
    }
}
