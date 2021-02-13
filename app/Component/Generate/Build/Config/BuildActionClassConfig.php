<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildActionClassConfig extends BaseObject
{
    /**
     * 命名空间
     * @var string
     */
    private $namespace;

    /**
     * 尾缀名
     * @var string
     */
    private $suffix;

    /**
     * @var null|string
     */
    private $firstNamespace;

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return BuildActionClassConfig
     */
    public function setNamespace(string $namespace): BuildActionClassConfig
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     *
     * @return BuildActionClassConfig
     */
    public function setSuffix(string $suffix): BuildActionClassConfig
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstNamespace(): ?string
    {
        return $this->firstNamespace;
    }

    /**
     * @param string|null $firstNamespace
     *
     * @return BuildActionClassConfig
     */
    public function setFirstNamespace(?string $firstNamespace): BuildActionClassConfig
    {
        $this->firstNamespace = $firstNamespace;
        return $this;
    }
}
