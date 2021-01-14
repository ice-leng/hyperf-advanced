<?php

namespace App\Component\Generate\Build\Action\Service;

class RemoveActionServiceBuild extends BaseActionServiceBuild
{

    public function getContent(): array
    {
        return  [
            "\$status = {$this->getModel()['classname']}::softDeleteCondition(\$params);",
            'if (!$status) {',
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['remove']});",
            '}',
            'return $status;',
        ];
    }

    public function getReturn(): string
    {
        return 'int';
    }
}
