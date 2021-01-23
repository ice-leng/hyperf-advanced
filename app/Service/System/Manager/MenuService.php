<?php

namespace App\Service\System\Manager;

use App\Constant\Errors\System\MenuError;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Common\Component\Entity\PageEntity;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\YiiSoft\Rbac\ManagerInterface;
use Lengbin\YiiSoft\Rbac\Menu;
use Throwable;

class MenuService extends BaseService
{

    /**
     * @Inject()
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @Inject
     * @var RoleService
     */
    protected $roleService;

    /**
     * @param array $params
     *
     * @return array
     */
    public function getMenus(array $params): array
    {
        $role = $params['role'] ?? '';
        $menus = $this->manager->getMenus($role);
        if (empty($params['pid'])) {
            $params['pid'] = '';
        }
        return array_values(array_filter($menus, function ($menu) use ($params) {
            return $menu->getPid() === $params['pid'];
        }));
    }

    /**
     * @param array           $params
     * @param array|string[]  $field
     * @param PageEntity|null $pageEntity
     *
     * @return array
     */
    public function getList(array $params = [], array $field = ['*'], ?PageEntity $pageEntity = null): array
    {
        $menus = $this->getMenus($params);
        $results = $this->pageByArray($menus, $pageEntity);
        return $this->toArray($results, function ($result) {
            $result = $result->getAttributes();
            if (!is_array($result['role'])) {
                $result['role'] = explode(',', $result['role']);
            }
            $result['create_at'] = date('Y-m-d H:i:s', $result['created_at']);
            $result['update_at'] = date('Y-m-d H:i:s', $result['updated_at']);
            return $result;
        });
    }

    /**
     * @param array $params
     *
     * @return Menu
     */
    protected function populateMenu(array $params): Menu
    {
        $role = $params['role'];
        if (!is_array($role)) {
            $role = [$role];
        }
        foreach ($role as $item) {
            $this->roleService->findOne($item);
        }
        return (new Menu($params['name']))->withPid($params['pid'])
            ->withIcon($params['icon'])
            ->withPath($params['path'])
            ->withSort($params['sort'])
            ->withTemplate($params['template'])
            ->withRole(implode(',', $role));
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function create(array $params): array
    {
        try {
            $menu = $this->populateMenu($params);
            $this->manager->add($menu);
            return $params;
        } catch (Throwable $exception) {
            throw new BusinessException(MenuError::ERROR_MENU_CREATE_FAIL);
        }
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function update(array $params): array
    {
        try {
            $menu = $this->populateMenu($params);
            $this->manager->update($params['name'], $menu);
            return $params;
        } catch (Throwable $exception) {
            throw new BusinessException(MenuError::ERROR_MENU_UPDATE_FAIL);
        }
    }

    /**
     * @param string $name
     *
     * @return Menu
     */
    public function findOne(string $name): Menu
    {
        $menu = $this->manager->getMenu($name);
        if (!$menu) {
            throw new BusinessException(MenuError::ERROR_MENU_NOT_FOUND);
        }
        return $menu;
    }

    /**
     * @param array          $params
     * @param array|string[] $field
     *
     * @return array
     */
    public function detail(array $params, array $field = ['*']): array
    {
        $menu = $this->findOne($params['name']);
        $result = $menu->getAttributes();
        $result['role'] = explode(',', $result['role']);
        $result['create_at'] = date('Y-m-d H:i:s', $result['created_at']);
        $result['update_at'] = date('Y-m-d H:i:s', $result['updated_at']);
        return $result;
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function remove(array $params): int
    {
        try {
            $menu = $this->findOne($params['name']);
            $this->manager->remove($menu);
            return 1;
        } catch (Throwable $exception) {
            throw new BusinessException(MenuError::ERROR_MENU_REMOVE_FAIL);
        }
    }
}
