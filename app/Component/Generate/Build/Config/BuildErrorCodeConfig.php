<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildErrorCodeConfig extends BaseObject
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
     * @var array
     */
    private $prefix;

    /**
     * @return array
     */
    public function getPrefix(): array
    {
        return $this->prefix;
    }

    /**
     * @param array $prefix
     *
     * @return BuildErrorCodeConfig
     */
    public function setPrefix(array $prefix): BuildErrorCodeConfig
    {
        $this->prefix = $prefix;
        return $this;
    }

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
     * @return BuildErrorCodeConfig
     */
    public function setInheritance(string $inheritance): BuildErrorCodeConfig
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
     * @return BuildErrorCodeConfig
     */
    public function setUse(string $use): BuildErrorCodeConfig
    {
        $this->use = $use;
        return $this;
    }
}
