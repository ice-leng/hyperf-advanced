<?php

namespace App\Service\System\Manager;

use App\Constant\Errors\System\PermissionError;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Lengbin\YiiSoft\Rbac\Item;
use Lengbin\YiiSoft\Rbac\ManagerInterface;
use Lengbin\YiiSoft\Rbac\Permission;
use Throwable;

class PermissionService extends BaseService
{
    /**
     * @Inject()
     * @var ManagerInterface
     */
    protected $manager;

    public function populateItem(array $row): Item
    {
        return (new Permission($row['name']))->withDescription($row['description'] ?? '')->withRuleName($row['rule_name'] ?? null);
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
            $permission = $this->populateItem($params);
            $this->manager->add($permission);
            if (!empty($params['node'])) {
                foreach ($params['node'] as $name) {
                    $node = $this->findOne($name);
                    if ($this->manager->hasChild($permission, $node) || $this->manager->canAddChild($permission, $node)) {
                        continue;
                    }
                    $this->manager->addChild($permission, $node);
                }
            }
            Db::commit();
            return $params;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(PermissionError::ERROR_PERMISSION_CREATE_FAIL);
        }
    }

    /**
     * @param string $name
     *
     * @return Permission
     */
    public function findOne(string $name): Permission
    {
        $permission = $this->manager->getPermission($name);
        if (!$permission) {
            throw new BusinessException(PermissionError::ERROR_PERMISSION_NOT_FOUND);
        }
        return $permission;
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
            $permission = $this->populateItem($params);
            $this->manager->update($params['name'], $permission);
            $this->manager->removeChildren($permission);
            if (!empty($params['node'])) {
                foreach ($params['node'] as $name) {
                    $node = $this->findOne($name);
                    if ($this->manager->hasChild($permission, $node) || $this->manager->canAddChild($permission, $node)) {
                        continue;
                    }
                    $this->manager->addChild($permission, $node);
                }
            }
            Db::commit();
            return $params;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(PermissionError::ERROR_PERMISSION_UPDATE_FAIL);
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
        $permission = $this->findOne($params['name']);
        $nodes = $this->manager->getPermissionsByRole($permission->getName());
        $data = [];
        foreach ($nodes as $node) {
            $data[] = $node->getName();
        }
        $description = explode("-", $permission->getDescription());
        array_shift($description);
        return [
            'name'             => $permission->getName(),
            'full_description' => $permission->getDescription(),
            'description'      => implode('', $description),
            'rule_name'        => $permission->getRuleName(),
            'node'             => $data,
            'create_at'        => date('Y-m-d H:i:s', $permission->getCreatedAt()),
            'update_at'        => date('Y-m-d H:i:s', $permission->getUpdatedAt()),
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
            $menu = $this->findOne($params['name']);
            $this->manager->remove($menu);
            Db::commit();
            return 1;
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(PermissionError::ERROR_PERMISSION_REMOVE_FAIL);
        }
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        $result = [];
        $permissions = $this->manager->getPermissions();
        foreach ($permissions as $permission) {
            $data = explode("-", $permission->getDescription());
            if (count($data) === 1) {
                continue;
            }
            $title = array_shift($data);
            if (empty($result[$title])) {
                $result[$title] = [];
            }
            $result[$title][] = [
                'name'             => $permission->getName(),
                'full_description' => $permission->getDescription(),
                'description'      => implode('', $data),
                'rule_name'        => $permission->getRuleName(),
                'create_at'        => date('Y-m-d H:i:s', $permission->getCreatedAt()),
                'update_at'        => date('Y-m-d H:i:s', $permission->getUpdatedAt()),
            ];
        }
        return $result;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function search(string $name): array
    {
        $permissions = array_keys($this->manager->getPermissions());
        return array_values(array_filter($permissions, function ($permission) use ($name) {
            return $permission === $name ? true : StringHelper::matchWildcard($name . '*', $permission);
        }));
    }
}
