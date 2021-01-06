<?php

namespace App\Service\System\Manager;

use App\Constant\Errors\System\RoleError;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\YiiSoft\Rbac\Item;
use Lengbin\YiiSoft\Rbac\ManagerInterface;
use Lengbin\YiiSoft\Rbac\Role;
use Throwable;

class RoleService extends BaseService
{
    /**
     * @Inject()
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @Inject
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * @param array           $params
     * @param array|string[]  $field
     * @param PageEntity|null $pageEntity
     *
     * @return array
     */
    public function getList(array $params = [], array $field = ['*'], ?PageEntity $pageEntity = null): array
    {
        $roles = $this->manager->getRoles();
        $results = $this->pageByArray($roles, $pageEntity);
        return $this->toArray($results, function ($result) {
            $result = [
                'name'        => $result->getName(),
                'description' => $result->getDescription(),
                'create_at'   => date('Y-m-d H:i:s', $result->getCreatedAt()),
                'update_at'   => date('Y-m-d H:i:s', $result->getUpdatedAt()),
            ];
            return $result;
        });
    }

    /**
     * @param array $row
     *
     * @return Item
     */
    public function populateItem(array $row): Item
    {
        return (new Role($row['name']))->withDescription($row['description'] ?? '')->withRuleName($row['rule_name'] ?? null);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function create(array $params): array
    {
        try {
            Db::beginTransaction();
            $role = $this->populateItem($params);
            $this->manager->add($role);
            foreach ($params['permission'] as $name) {
                $permission = $this->permissionService->findOne($name);
                if ($this->manager->hasChild($role, $permission)) {
                    continue;
                }
                $this->manager->addChild($role, $permission);
            }
            Db::commit();
            return $params;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(RoleError::ERROR_ROLE_CREATE_FAIL);
        }
    }

    /**
     * @param string $name
     *
     * @return Role
     */
    public function findOne(string $name): Role
    {
        $role = $this->manager->getRole($name);
        if (!$role) {
            throw new BusinessException(RoleError::ERROR_ROLE_NOT_FOUND);
        }
        return $role;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function update(array $params): array
    {
        try {
            Db::beginTransaction();
            $this->findOne($params['name']);
            $role = $this->populateItem($params);
            $this->manager->update($params['name'], $role);
            $this->manager->removeChildren($role);
            foreach ($params['permission'] as $name) {
                $permission = $this->permissionService->findOne($name);
                if ($this->manager->hasChild($role, $permission)) {
                    continue;
                }
                $this->manager->addChild($role, $permission);
            }
            Db::commit();
            return $params;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(RoleError::ERROR_ROLE_UPDATE_FAIL);
        }
    }

    /**
     * @param array          $params
     * @param array|string[] $field
     *
     * @return array
     */
    public function detail(array $params, array $field = ['*']): array
    {
        $role = $this->findOne($params['name']);
        $permissions = $this->manager->getPermissionsByRole($role->getName());
        $data = [];
        foreach ($permissions as $permission) {
            $data[] = $permission->getName();
        }
        return [
            'name'        => $role->getName(),
            'description' => $role->getDescription(),
            'permission'  => $data,
            'create_at'   => date('Y-m-d H:i:s', $role->getCreatedAt()),
            'update_at'   => date('Y-m-d H:i:s', $role->getUpdatedAt()),
        ];
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function remove(array $params): int
    {
        try {
            $role = $this->findOne($params['name']);
            $this->manager->remove($role);
            Db::commit();
            return 1;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(RoleError::ERROR_ROLE_REMOVE_FAIL);
        }
    }
}
