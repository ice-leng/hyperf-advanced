<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

class Config extends BaseObject
{
    /**
     * @var ?string
     */
    private $namespace;

    /**
     * @var array
     */
    private $uses = [];

    /**
     * @var string
     */
    private $classname;

    /**
     * @var ?string
     */
    private $inheritance;

    /**
     * @var array
     */
    private $implements = [];

    /**
     * @var ClassMethod[]
     */
    private $methods = [];

    /**
     * @var ClassProperty[]
     */
    private $properties = [];

    /**
     * @return ?string
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return Config
     */
    public function setNamespace(string $namespace): Config
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return array
     */
    public function getUses(): array
    {
        return $this->uses;
    }

    /**
     * @param array $uses
     *
     * @return Config
     */
    public function setUses(array $uses): Config
    {
        $this->uses = $uses;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassname(): string
    {
        return $this->classname;
    }

    /**
     * @param string $classname
     *
     * @return Config
     */
    public function setClassname(string $classname): Config
    {
        $this->classname = $classname;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInheritance(): ?string
    {
        return $this->inheritance;
    }

    /**
     * @param string $inheritance
     *
     * @return Config
     */
    public function setInheritance(string $inheritance): Config
    {
        $this->inheritance = $inheritance;
        return $this;
    }

    /**
     * @return array
     */
    public function getImplements(): array
    {
        return $this->implements;
    }

    /**
     * @param array $implements
     *
     * @return Config
     */
    public function setImplements(array $implements): Config
    {
        $this->implements = $implements;
        return $this;
    }

    /**
     * @return ClassMethod[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param ClassMethod[] $methods
     *
     * @return Config
     */
    public function setMethods(array $methods): Config
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @return ClassProperty[]
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param ClassProperty[] $properties
     *
     * @return Config
     */
    public function setProperties(array $properties): Config
    {
        $this->properties = $properties;
        return $this;
    }

}
