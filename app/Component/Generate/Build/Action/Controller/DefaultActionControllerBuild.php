<?php

namespace App\Component\Generate\Build\Action\Controller;

class DefaultActionControllerBuild extends BaseActionControllerBuild
{
    public function getComment(): array
    {
        $comment = parent::getComment();
        $comment[] = '@ApiResponse(code="0", template="success")';
        return $comment;
    }

    public function getContent(): array
    {
        return [
            '$params = Context::get("validator.data", []);',
            '$this->'.$this->getServiceName().'->'.$this->getName().'($params);',
            'return $this->success([]);'
        ];
    }
}
