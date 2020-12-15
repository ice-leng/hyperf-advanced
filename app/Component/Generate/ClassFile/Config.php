<?php

namespace App\Component\Generate\ClassFile;

use App\Component\Generate\AbstractConfig;

class Config extends AbstractConfig
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
    private $comments;

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

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     *
     * @return Config
     */
    public function setComments(array $comments): Config
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->getClassname();
    }

    /**
     * @param string $str
     * @param array  $comments
     *
     * @return string
     */
    protected function renderComment(string $str, array $comments = []): string
    {
        $str .= "/**\n";
        foreach ($comments as $comment) {
            $str .= " * {$comment}\n";
        }
        $str .= " */\n";
        return $str;
    }

    /**
     * @param ClassBase $classBase
     *
     * @return string
     */
    protected function getScope(ClassBase $classBase): string
    {
        $str = '';
        if ($classBase->getPublic()) {
            $str = 'public';
        }

        if ($classBase->getProtected()) {
            $str = 'protected';
        }

        if ($classBase->getPrivate()) {
            $str = 'private';
        }

        if ($classBase->getStatic()) {
            $str .= ' static';
        }
        return $str;
    }

    protected function renderProperty(string $str): string
    {
        if (!empty($this->getProperties())) {
            // constant
            foreach ($this->getProperties() as $classProperty) {
                if (!$classProperty->getConst()) {
                    continue;
                }
                if (!empty($classProperty->getComments())) {
                    $str = $this->renderComment($str, $classProperty->getComments());
                }
                $str .= "{$this->getScope($classProperty)} $" . $classProperty->getName() . ";\n";
            }
            // property
            foreach ($this->getProperties() as $classProperty) {
                if ($classProperty->getConst()) {
                    continue;
                }
                if (!empty($classProperty->getComments())) {
                    $str = $this->renderComment($str, $classProperty->getComments());
                }
                $str .= "{$this->getScope($classProperty)} $" . $classProperty->getName() . ";\n";
            }
        }
        return $str;
    }

    protected function renderMethod(string $str): string
    {
        return $str;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        // <?php
        $str = "<?php\n\ndeclare(strict_types=1);\n\n";

        // namespace
        if (!empty($this->getNamespace())) {
            $str .= "namespace {$this->getNamespace()};\n\n";
        }

        // uses
        if (!empty($this->getUses())) {
            foreach ($this->getUses() as $use) {
                $str .= "use {$use};\n";
            }
            $str .= "\n";
        }

        // class comment
        if (!empty($this->getComments())) {
            $str = $this->renderComment($str, $this->getComments());
        }

        // class
        $str .= "class {$this->getClassname()}";
        if (!empty($this->getInheritance())) {
            $str .= " extends {$this->getInheritance()}";
        }
        if (!empty($this->getImplements())) {
            $implement = implode(', ', $this->getImplements());
            $str .= " implements {$implement}";
        }
        $str .= "\n{\n";

        if (empty($this->getProperties()) && empty($this->getMethods())) {
            $str .= "{$this->getSpaces()}\n";
        } else {
            // properties
            $str = $this->renderProperty($str);
            // methods
            $str = $this->renderMethod($str);
        }
        $str .= "}\n";
        return $str;
    }
}
