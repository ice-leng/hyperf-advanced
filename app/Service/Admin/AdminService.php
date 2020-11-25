<?php

namespace App\Service\Admin;

use App\Model\Admin;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Framework\BaseService;

class AdminService extends BaseService
{
    public function getList(array $params = [], array $field = ['*'], ?PageEntity $pageEntity = null): array
    {
        $query = Admin::query();
        return $pageEntity ? $this->page($query, $pageEntity) : $query->get()->all();
    }
}
