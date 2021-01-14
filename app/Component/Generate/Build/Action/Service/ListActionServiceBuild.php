<?php

namespace App\Component\Generate\Build\Action\Service;

use Lengbin\Hyperf\Common\Constant\SoftDeleted;
use Lengbin\Hyperf\Common\Entity\PageEntity;

class ListActionServiceBuild extends BaseActionServiceBuild
{

    public function getUses(): array
    {
        return [
            PageEntity::class,
            SoftDeleted::class,
        ];
    }

    public function getContent(): array
    {
        $data = [
            "\$query = {$this->getModel()['classname']}::query();",
            '$query->select($field);',
            "\$query->where(['enable' => SoftDeleted::ENABLE]);",
        ];
        // 判断  条件 search
        $data[] = '$results = $pageEntity ? $this->page($query, $pageEntity) : $query->get()->all();';
        $data[] = 'return $this->toArray($results, [$this, "formatModel"]);';
        return $data;
    }

    public function getParams(): array
    {
        return [
            ['name' => 'params', 'type' => 'array', 'default' => [], 'comment' => '条件'],
            ['name' => 'field', 'type' => 'array', 'default' => ['*'], 'comment' => '字段' ],
            ['name' => 'pageEntity', 'type' => '?PageEntity', 'default' => null, 'comment' => '分页'],
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
