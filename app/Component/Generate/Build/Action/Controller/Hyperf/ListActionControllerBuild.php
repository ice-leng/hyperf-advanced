<?php

namespace App\Component\Generate\Build\Action\Controller\Hyperf;

use App\Component\Generate\Build\Action\Controller\BaseActionControllerBuild;
use Lengbin\Common\Component\Entity\PageEntity;

class ListActionControllerBuild extends BaseActionControllerBuild
{
    public function getComment(): array
    {
        $comment = parent::getComment();
        $comment[] = '@ApiResponse(code="0", template="page")';
        return $comment;
    }

    public function getUses(): array
    {
        return [
            PageEntity::class,
        ];
    }

    public function getContent(): array
    {
        // todo filed
        // $this->getValidateParse()->getParams();
        return [
            '$params = Context::get("validator.data", []);',
            '$page = new PageEntity($params);',
            '$data = $this->' . $this->getServiceName() . '->' . $this->getName() . '($params, ["*"], $page);',
            'return $this->success($data);',
        ];
    }
}
