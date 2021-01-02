<?php

namespace App\Service\System\Manager;

use Lengbin\Hyperf\Common\Entity\PageEntity;

class MenuService extends ManagerService
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
        $menus = $this->manager->getMenus();
        return $this->pageByArray($menus, $pageEntity);
    }
}
