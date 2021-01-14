<?php

namespace App\Service\Admin;

use App\Constant\Errors\AdminError;
use App\Constant\Status\AdminStatus;
use App\Model\Admin;
use App\Service\System\Manager\RoleService;
use EasySwoole\Utility\SnowFlake;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Helper\Util\PasswordHelper;
use Lengbin\Hyperf\Common\Constant\SoftDeleted;
use Lengbin\Hyperf\Common\Entity\PageEntity;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use Lengbin\Hyperf\Common\Framework\BaseService;
use Throwable;

/**
 * Class AdminService
 * @package App\Service\Admin
 */
class AdminService extends BaseService
{

    /**
     * @Inject()
     * @var RoleService
     */
    protected $roleService;

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
        $query->select($field);
        $query->where(['enable' => SoftDeleted::ENABLE]);

        if (!empty($params['search'])) {
            $query->where([
                ["account", 'like', "%{$params['search']}%"],
                ["nickname", 'like', "%{$params['search']}%", 'or'],
            ]);
        }

        if (!empty($params['status'])) {
            $query->where(['status' => $params['status']]);
        }

        $results = $pageEntity ? $this->page($query, $pageEntity) : $query->get()->all();
        return $this->toArray($results, [$this, 'formatAdmin']);
    }

    /**
     * 格式化数据
     *
     * @param array $admin
     *
     * @return array
     */
    protected function formatAdmin(array $admin): array
    {
        if (!empty($admin['status'])) {
            $admin['status_message'] = AdminStatus::byValue($admin['status'])->getMessage();
        }

        return $admin;
    }

    public function detail(array $params, array $field = ['*']): array
    {
        $result = $this->findOne($params, $field);
        return $this->formatAdmin($result->toArray());
    }

    /**
     * @param array    $conditions
     * @param string[] $field
     *
     * @return Admin
     */
    public function findOne(array $conditions, $field = ['*']): Admin
    {
        $model = Admin::findOneCondition($conditions, $field);
        if (!$model) {
            throw new BusinessException(AdminError::ERROR_ADMIN_NOT_FOUND);
        }
        return $model;
    }

    /**
     * @return int
     */
    protected function getNumber(): int
    {
        $count = Admin::query()->count();
        return ++$count;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function create(array $params): array
    {
        $check = Admin::existCondition([
            'account' => $params['account'],
        ]);
        if ($check) {
            throw new BusinessException(AdminError::ERROR_ADMIN_EXIST);
        }
        $this->roleService->findOne($params['role']);
        try {
            Db::beginTransaction();
            $model = new Admin();
            $params['admin_id'] = SnowFlake::make(1, 1);
            $params['status'] = AdminStatus::NORMAL;
            $params['number'] = $this->getNumber();
            $params['enable'] = SoftDeleted::ENABLE;
            $params['password'] = PasswordHelper::generatePassword($params['password']);
            $status = $model->insert($params);
            if (!$status) {
                throw new BusinessException(AdminError::ERROR_ADMIN_CREATE_FAIL);
            }
            $this->roleService->assign($model->role, $model->admin_id);
            Db::commit();
            return $model->toArray();
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(AdminError::ERROR_ADMIN_CREATE_FAIL);
        }
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function update(array $params): array
    {
        $model = $this->findOne([
            'admin_id' => $params['admin_id'],
        ]);

        if (!empty($params['password'])) {
            $params['password'] = PasswordHelper::generatePassword($params['password']);
        }

        $role = '';
        if (!empty($params['role']) && $model->role !== $params['role']) {
            $role = $this->roleService->findOne($params['role']);
        }

        try {
            Db::beginTransaction();
            $status = $model->update($params);
            if (!$status) {
                throw new BusinessException(AdminError::ERROR_ADMIN_UPDATE_FAIL);
            }
            if (!empty($role)) {
                $this->roleService->revoke($model->admin_id);
                $this->roleService->assign($model->role, $model->admin_id);
            }
            Db::commit();
            return $model->toArray();
        } catch (Throwable $exception) {
            Db::rollBack();
            throw new BusinessException(AdminError::ERROR_ADMIN_UPDATE_FAIL);
        }
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function remove(array $params): int
    {
        $status = Admin::softDeleteCondition($params);
        if (!$status) {
            throw new BusinessException(AdminError::ERROR_ADMIN_DELETE_FAIL);
        }
        return $status;
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function changeStatus(array $params): int
    {
        $admin = Admin::findAllCondition(['admin_id' => $params['admin_id']]);
        if (count($admin) !== count($params['admin_id'])) {
            throw new BusinessException(AdminError::ERROR_ADMIN_NOT_FOUND);
        }
        $status = Admin::updateCondition(['admin_id' => $params['admin_id']], ['status' => $params['status']]);
        if (!$status) {
            throw new BusinessException(AdminError::ERROR_ADMIN_UPDATE_FAIL);
        }
        return $status;
    }

}
