<?php

namespace App\Component\Generate\Build\Action\Service;

class DetailActionServiceBuild extends BaseActionServiceBuild
{

    public function getContent(): array
    {
        return [
            '$result = $this->findOne($params, $field);',
            'return $this->formatModel($result->toArray());',
        ];
    }

    public function getParams(): array
    {
        return  [
            ['name' => 'params', 'type' => 'array', 'comment' => '条件'],
            ['name' => 'field', 'type' => 'array', 'default' => ['*'], 'comment' => '字段'],
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
