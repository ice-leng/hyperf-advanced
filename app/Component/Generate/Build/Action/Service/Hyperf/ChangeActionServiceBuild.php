<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class ChangeActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        $primaryKey = $this->getModel()->getPrimaryKey();
        return [
            "\$where = ['{$primaryKey}' => \$params['{$primaryKey}']];",
            "unset(\$params['{$primaryKey}']);",
            "\$models = {$this->getModel()->getClassname()}::findAllCondition(\$where);",
            "if (count(\$models) !== count(\$params['{$primaryKey}'])) {",
                $this->throwExceptionForError('notFound'),
            '}',
            "\$status = {$this->getModel()->getClassname()}::updateCondition(\$where, \$params);",
            'if (!$status) {',
                $this->throwExceptionForError('update'),
            '}',
            'return $status;',
        ];
    }

    public function getReturn(): string
    {
        return 'int';
    }
}
