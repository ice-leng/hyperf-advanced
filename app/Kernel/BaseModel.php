<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  4:34 下午
 */

declare(strict_types=1);

namespace App\Kernel;

use App\Kernel\Constants\SoftDeleted;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Query\Expression;
use Hyperf\Database\Query\Grammars\Grammar;
use Hyperf\DbConnection\Db;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Utils\Arr;

abstract class BaseModel extends Model
{
    const CREATED_AT = 'create_at';

    const UPDATED_AT = 'update_at';

    protected $dateFormat = 'U';

    /**
     * 删除
     * @return bool
     */
    public function disable()
    {
        $this->enable = SoftDeleted::DISABLE;
        return $this->save();
    }

    /**
     * @param mixed $value
     * @return string
     */
    public function fromDateTime($value)
    {
        return strval($this->asTimestamp($value));
    }

    public static function betweenTime(Builder $model, string $field, array $data)
    {
        $model->where(function (Builder $builder) use ($field, $data) {
            if ($data['start'] > 0) {
                $builder->where($field, '>=', $data['start']);
            }
            if ($data['end'] > 0) {
                $builder->where($field, '<', $data['end']);
            }
        });
    }

    /**
     * @param array $conditions
     * @param array $field
     * @param bool $forUpdate
     * @return null|BaseModel|object|static
     */
    public static function findOneCondition(array $conditions, $field = ['*'], $forUpdate = false): ?self
    {
        $model = self::query();

        if (count($conditions) === count($conditions, 1)) {
            foreach ($conditions as $key => $value) {
                if (is_null($value)) {
                    continue;
                }
                if (is_array($value)) {
                    $model->whereIn($key, $value);
                } else {
                    $model->where($key, $value);
                }
            }
        } else {
            $model->where($conditions);
        }

        $model->where('enable', SoftDeleted::ENABLE);
        if ($forUpdate) {
            $model->lockForUpdate();
        }
        return $model->first($field);
    }

    /**
     * @param array $conditions
     * @param array $field
     * @param bool $forUpdate
     * @return \Hyperf\Database\Model\Collection|static[]
     */
    public static function findCondition(array $conditions, $field = ['*'], $forUpdate = false)
    {
        $model = self::query();
        if (count($conditions) === count($conditions, 1)) {
            foreach ($conditions as $key => $value) {
                if (is_null($value)) {
                    continue;
                }
                if (is_array($value)) {
                    $model->whereIn($key, $value);
                } else {
                    $model->where($key, $value);
                }
            }
        } else {
            $model->where($conditions);
        }
        $model->where('enable', SoftDeleted::ENABLE);
        if ($forUpdate) {
            $model->lockForUpdate();
        }
        return $model->get($field);
    }

    /**
     * insert or update a record
     *
     * @param array $values
     * @param array $column
     * @return bool
     */
    public static function insertOrUpdate(array $values, array $column)
    {
        if (empty($column)) {
            $column = array_keys($values);
        }
        $value = [];
        foreach ($column as $item) {
            $value[$item] = Db::raw("values(`{$item}`)");
        }
        $model = new static();
        $connection = $model->getConnection();   // 数据库连接
        $builder = $model->newQuery()->getQuery();   // 查询构造器
        $grammar = $builder->getGrammar();  // 语法器
        // 编译插入语句
        $insert = $grammar->compileInsert($builder, $values);
        // 编译重复后更新列语句。
        $update = $model->compileUpdateColumns($grammar, $value);
        // 构造查询语句
        $query = $insert . ' on duplicate key update ' . $update;
        // 组装sql绑定参数
        $bindings = $model->prepareBindingsForInsertOrUpdate($values, $value);
        // 执行数据库查询
        return $connection->insert($query, $bindings);
    }

    /**
     * Compile all of the columns for an update statement.
     *
     * @param Grammar $grammar
     * @param array $values
     * @return string
     */
    private function compileUpdateColumns(Grammar $grammar, array $values)
    {
        return collect($values)->map(function ($value, $key) use ($grammar) {
            return $grammar->wrap($key) . ' = ' . $grammar->parameter($value);
        })->implode(', ');
    }

    /**
     * Prepare the bindings for an insert or update statement.
     *
     * @param array $values
     * @param array $value
     * @return array
     */
    private function prepareBindingsForInsertOrUpdate(array $values, array $value)
    {
        // Merge array of bindings
        $bindings = array_merge_recursive($values, [$value]);
        // Remove all of the expressions from a list of bindings.
        return array_values(array_filter(Arr::flatten($bindings, 1), function ($binding) {
            return !$binding instanceof Expression;
        }));
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
