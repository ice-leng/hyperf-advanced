<?php

namespace App\Component\Generate\Build\Action\Service\Hyperf;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;

class FormatModelActionServiceBuild extends BaseActionServiceBuild
{
    public function getContent(): array
    {
        return [
            "// TODO: Implement {$this->getName()} method.",
            'return $result;',
        ];
    }

    public function getMethod(): array
    {
        $method = parent::getMethod();
        $method['protected'] = true;
        return $method;
    }

    public function getParams(): array
    {
        return [
            ['name' => 'result', 'type' => 'array', 'comment' => '数据'],
        ];
    }

    public function getReturn(): string
    {
        return 'array';
    }
}
