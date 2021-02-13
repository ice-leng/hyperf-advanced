<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class FindOneActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        return [
            "\$model = {$this->getModel()->getClassname()}::findOneCondition(\$params, \$field);",
            'if (!$model) {',
                $this->throwExceptionForError('notFound'),
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
        return $this->getModel()->getClassname();
    }
}
