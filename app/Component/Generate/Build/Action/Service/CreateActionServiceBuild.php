<?php

namespace App\Component\Generate\Build\Action\Service;

class CreateActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        // todo  判断 exist
        return [
            "\$model = new {$this->getModel()['classname']}();",
            '$status = $model->insert($params);',
            'if (!$status) {',
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['create']});",
            '}',
            'return $model->toArray();',
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
