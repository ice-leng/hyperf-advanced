<?php

namespace App\Component\Generate\Build\Action\Service;

class FindOneActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        return [
            "\$model = {$this->getModel()['classname']}::findOneCondition(\$params, \$field);",
            'if (!$model) {',
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['notFound']});",
            '}',
            'return $model;',
        ];
    }

    public function getParams(): array
    {
        return [
            ['name' => 'params', 'type' => 'array', 'comment' => '条件'],
            ['name' => 'field', 'type' => 'array', 'default' => ['*'], 'comment' => '字段'],
        ];
    }

    public function getReturn(): string
    {
        return $this->getModel()['classname'];
    }
}
