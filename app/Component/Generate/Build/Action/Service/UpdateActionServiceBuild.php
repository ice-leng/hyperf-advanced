<?php

namespace App\Component\Generate\Build\Action\Service;

class UpdateActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        // todo  判断 exist
        $primaryKey = $this->getModel()['primaryKey'];
        return [
            "\$model = \$this->findOne(['{$primaryKey}' => \$params['{$primaryKey}']]);",
            '$status = $model->update($params);',
            'if (!$status) {',
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['update']});",
            '}',
            'return $model->toArray();',
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
