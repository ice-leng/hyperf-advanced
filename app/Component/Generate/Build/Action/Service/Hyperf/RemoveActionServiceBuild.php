<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class RemoveActionServiceBuild extends BaseActionServiceBuild
{

    public function getContent(): array
    {
        return  [
            "\$status = {$this->getModel()->getClassname()}::softDeleteCondition(\$params);",
            'if (!$status) {',
                $this->throwExceptionForError($this->getName()),
            '}',
            'return $status;',
        ];
    }

    public function getReturn(): string
    {
        return 'int';
    }
}
