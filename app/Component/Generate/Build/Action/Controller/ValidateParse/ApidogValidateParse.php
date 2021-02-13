<?php

namespace App\Component\Generate\Build\Action\Controller\ValidateParse;

class ApidogValidateParse extends BaseValidateParse
{
    public function parse(): array
    {
        // todo rules by form
        $rules = [];
        $rule = $rules ? json_encode($rules, JSON_PRETTY_PRINT) : '';
        return [
            '@PostApi(path="' . $this->getPath() . '", summary="' . $this->getDescription() . '")',
            '@Body(rules={',
            $rule,
            '})',
        ];
    }
}
