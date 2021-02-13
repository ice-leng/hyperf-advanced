<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class UpdateActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        // todo  判断 exist
        $primaryKey = $this->getModel()->getPrimaryKey();
        return [
            "\$model = \$this->findOne(['{$primaryKey}' => \$params['{$primaryKey}']]);",
            '$status = $model->update($params);',
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
