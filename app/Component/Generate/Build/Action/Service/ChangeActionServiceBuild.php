<?php

namespace App\Component\Generate\Build\Action\Service;

class ChangeActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        $primaryKey = $this->getModel()['primaryKey'];
        return [
            "\$where = ['{$primaryKey}' => \$params['{$primaryKey}']];",
            "unset(\$params['{$primaryKey}']);",
            "\$models = {$this->getModel()['classname']}::findAllCondition(\$where);",
            "if (count(\$models) !== count(\$params['{$primaryKey}'])) {",
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['notFound']});",
            '}',
            "\$status = {$this->getModel()['classname']}::updateCondition(\$where, \$params);",
            'if (!$status) {',
            $this->getSpaces() . "throw new {$this->getExceptionName()}({$this->getErrors()['classname']}::{$this->getErrors()['constant']['update']});",
            '}',
            'return $status;',
        ];
    }

    public function getReturn(): string
    {
        return 'int';
    }
}
