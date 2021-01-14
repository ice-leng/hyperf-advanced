<?php

namespace App\Component\Generate\Build\Action\Service;

class DefaultActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        if (empty($this->getErrors()['constant'][$this->getName()])) {
            return [];
        }
        return [
            $this->getSpaces(2) . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant'][$this->getName()]});",
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
