<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class DefaultActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        if (empty($this->getError()->getConstant($this->getName()))) {
            return [];
        }
        return [
            $this->throwExceptionForError($this->getName()),
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
