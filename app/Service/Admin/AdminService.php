<?php

namespace App\Service\Admin;

use App\Model\Admin;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Framework\BaseService;

class AdminService extends BaseService
{
    /**
     * @param array           $params
     * @param array|string[]  $field
     * @param PageEntity|null $pageEntity
     *
     * @return array
     */
    public function getList(array $params = [], array $field = ['*'], ?PageEntity $pageEntity = null): array
    {
        $query = Admin::query();
        return $pageEntity ? $this->page($query, $pageEntity) : $query->get()->all();
    }
}
