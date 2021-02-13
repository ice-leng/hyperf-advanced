<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildDefaultBaseConfig extends BaseObject
{
    /**
     * 路径
     * @var string
     */
    protected $path;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return BuildDefaultBaseConfig
     */
    public function setPath(string $path): BuildDefaultBaseConfig
    {
        $this->path = $path;
        return $this;
    }
}
