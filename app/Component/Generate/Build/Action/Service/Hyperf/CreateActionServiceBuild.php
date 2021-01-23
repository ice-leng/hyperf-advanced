<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class CreateActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        // todo  判断 exist
        return [
            "\$model = new {$this->getModel()->getClassname()}();",
            '$status = $model->insert($params);',
            'if (!$status) {',
                $this->throwExceptionForError($this->getName()),
            '}',
            'return $model->toArray();',
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
