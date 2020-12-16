<?php

namespace App\Component\Generate\ClassFile;

use App\Component\Generate\AbstractConfig;
use Lengbin\Helper\YiiSoft\StringHelper;

class Config extends AbstractConfig
{
    /**
     * @var bool
     */
    private $final = false;

    /**
     * @var bool
     */
    private $abstract = false;

    /**
     * @var bool
     */
    private $interface = false;

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
    private $comments = [];

    /**
     * @var array
     */
    private $implements = [];

    /**
     * @var ClassConstant[]
     */
    private $constants = [];

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

    public function addUse(string $use): Config
    {
        $this->uses[] = $use;
        return $this;
    }

    /**
     * @param string $comment
     *
     * @return $this
     */
    public function addComment(string $comment): Config
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @param string $implement
     *
     * @return $this
     */
    public function addImplement(string $implement): Config
    {
        $this->implements[] = $implement;
        return $this;
    }

    /**
     * @param ClassMethod $classMethod
     *
     * @return $this
     */
    public function addMethod(ClassMethod $classMethod): Config
    {
        $this->methods[] = $classMethod;
        return $this;
    }

    /**
     * @param ClassProperty $classProperty
     *
     * @return $this
     */
    public function addProperty(ClassProperty $classProperty): Config
    {
        $this->properties[] = $classProperty;
        return $this;
    }

    /**
     * @param ClassConstant $constant
     *
     * @return $this
     */
    public function addCont(ClassConstant $constant): Config
    {
        $this->constants[] = $constant;
        return $this;
    }

    /**
     * @return bool
     */
    public function getFinal(): bool
    {
        return $this->final;
    }

    /**
     * @param bool $final
     *
     * @return Config
     */
    public function setFinal(bool $final): Config
    {
        $this->final = $final;
        if ($final === true) {
            $this->setAbstract(false);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @param bool $abstract
     *
     * @return Config
     */
    public function setAbstract(bool $abstract): Config
    {
        $this->abstract = $abstract;
        if ($abstract === true) {
            $this->setFinal(false);
        }
        return $this;
    }

    /**
     * @return ClassConstant[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param ClassConstant[] $constants
     *
     * @return Config
     */
    public function setConstants(array $constants): Config
    {
        $this->constants = $constants;
        return $this;
    }

    /**
     * @return bool
     */
    public function getInterface(): bool
    {
        return $this->interface;
    }

    /**
     * @param bool $interface
     *
     * @return Config
     */
    public function setInterface(bool $interface): Config
    {
        $this->interface = $interface;
        return $this;
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
     * 获取 作用域
     *
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
                $str .= "{$this->getScope($classProperty)}" . StringHelper::strtoupper($classProperty->getName(), 'utf8') . ";\n";
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

        //
        if ($this->getFinal()) {

        }

        if ($this->getAbstract()) {

        }

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
