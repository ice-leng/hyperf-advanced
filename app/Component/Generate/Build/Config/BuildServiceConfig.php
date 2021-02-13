<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildServiceConfig extends BaseObject
{
    /**
     * 继承
     * @var string
     */
    private $inheritance;

    /**
     * 使用  命名空间
     * @var string
     */
    private $use;

    /**
     * @return string
     */
    public function getInheritance(): string
    {
        return $this->inheritance;
    }

    /**
     * @param string $inheritance
     *
     * @return BuildServiceConfig
     */
    public function setInheritance(string $inheritance): BuildServiceConfig
    {
        $this->inheritance = $inheritance;
        return $this;
    }

    /**
     * @return string
     */
    public function getUse(): string
    {
        return $this->use;
    }

    /**
     * @param string $use
     *
     * @return BuildServiceConfig
     */
    public function setUse(string $use): BuildServiceConfig
    {
        $this->use = $use;
        return $this;
    }
}
