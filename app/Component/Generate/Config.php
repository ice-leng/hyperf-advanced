<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

class Config extends BaseObject
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var array
     */
    private $uses;

    /**
     * @var string
     */
    private $classname;

    /**
     * @var string
     */
    private $inheritance;

    /**
     * @var string
     */
    private $implement;

    /**
     * @var array
     */
    private $functions;

    /**
     * @var array
     */
    private $annotations;

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
     * @return string
     */
    public function getInheritance(): string
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
     * @return string
     */
    public function getImplement(): string
    {
        return $this->implement;
    }

    /**
     * @param string $implement
     *
     * @return Config
     */
    public function setImplement(string $implement): Config
    {
        $this->implement = $implement;
        return $this;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    /**
     * @param array $functions
     *
     * @return Config
     */
    public function setFunctions(array $functions): Config
    {
        $this->functions = $functions;
        return $this;
    }

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * @param array $annotations
     *
     * @return Config
     */
    public function setAnnotations(array $annotations): Config
    {
        $this->annotations = $annotations;
        return $this;
    }
}
