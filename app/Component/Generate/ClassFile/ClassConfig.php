<?php

namespace App\Component\Generate\ClassFile;

use App\Component\Generate\AbstractConfig;

class ClassConfig extends AbstractConfig
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
     * @return ClassConfig
     */
    public function setNamespace(string $namespace): ClassConfig
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
     * @return ClassConfig
     */
    public function setUses(array $uses): ClassConfig
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
     * @return ClassConfig
     */
    public function setClassname(string $classname): ClassConfig
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
     * @return ClassConfig
     */
    public function setInheritance(string $inheritance): ClassConfig
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
     * @return ClassConfig
     */
    public function setImplements(array $implements): ClassConfig
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
     * @return ClassConfig
     */
    public function setMethods(array $methods): ClassConfig
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
     * @return ClassConfig
     */
    public function setProperties(array $properties): ClassConfig
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
     * @return ClassConfig
     */
    public function setComments(array $comments): ClassConfig
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
     * @param string $use
     *
     * @return ClassConfig
     */
    public function addUse(string $use): ClassConfig
    {
        $this->uses[] = $use;
        return $this;
    }

    /**
     * @param string $comment
     *
     * @return ClassConfig
     */
    public function addComment(string $comment): ClassConfig
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @param string $implement
     *
     * @return ClassConfig
     */
    public function addImplement(string $implement): ClassConfig
    {
        $this->implements[] = $implement;
        return $this;
    }

    /**
     * @param ClassMethod $classMethod
     *
     * @return ClassConfig
     */
    public function addMethod(ClassMethod $classMethod): ClassConfig
    {
        $this->methods[] = $classMethod;
        return $this;
    }

    /**
     * @param ClassProperty $classProperty
     *
     * @return ClassConfig
     */
    public function addProperty(ClassProperty $classProperty): ClassConfig
    {
        $this->properties[] = $classProperty;
        return $this;
    }

    /**
     * @param ClassConstant $constant
     *
     * @return ClassConfig
     */
    public function addCont(ClassConstant $constant): ClassConfig
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
     * @return ClassConfig
     */
    public function setFinal(bool $final): ClassConfig
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
     * @return ClassConfig
     */
    public function setAbstract(bool $abstract): ClassConfig
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
     * @return ClassConfig
     */
    public function setConstants(array $constants): ClassConfig
    {
        $this->constants = $constants;
        return $this;
    }

    /**
     * @return bool
     */
    public function getInterface(): bool
    {
        $this->setImplements([]);
        return $this->interface;
    }

    /**
     * @param bool $interface
     *
     * @return ClassConfig
     */
    public function setInterface(bool $interface): ClassConfig
    {
        $this->interface = $interface;
        return $this;
    }

    /**
     * @return string
     */
    protected function renderUses(): string
    {
        $data = [];
        if (!empty($this->getUses())) {
            foreach ($this->getUses() as $use) {
                $data[] = "use {$use};";
            }
        }
        return implode("\n", $data);
    }

    /**
     * @param array $comments
     * @param int   $level
     *
     * @return string
     */
    protected function renderComment(array $comments = [], int $level = 0): string
    {
        $data = [];
        if (!empty($comments)) {
            $data[] = "{$this->getSpaces($level)}/**";
            foreach ($comments as $comment) {
                $data[] = "{$this->getSpaces($level)} * {$comment}";
            }
            $data[] = "{$this->getSpaces($level)} */";
        }
        return implode("\n", $data);
    }

    /**
     * @return string
     */
    protected function renderClassname(): string
    {
        $str = '';
        if ($this->getFinal()) {
            $str .= "final";
        }
        if ($this->getAbstract()) {
            $str .= "abstract";
        }

        $str .= ($this->getInterface() ? 'interface' : 'class') . " {$this->getClassname()}";

        if (!empty($this->getInheritance())) {
            $str .= " extends {$this->getInheritance()}";
        }
        if (!empty($this->getImplements())) {
            $implement = implode(', ', $this->getImplements());
            $str .= " implements {$implement}";
        }
        return $str;
    }

    /**
     * @return string
     */
    protected function renderConst(): string
    {
        $data = [];
        if (!empty($this->getConstants())) {
            foreach ($this->getConstants() as $constant) {
                // if not comment, add name
                if (empty($constant->getComments()) && !is_null($constant->getDefault())) {
                    $constant->addComment($constant->getName());
                }
                if (!empty($constant->getComments())) {
                    $data[] = $this->renderComment($constant->getComments(), 1);
                }
                $data[] = ("{$this->getSpaces()}{$this->getScope($constant)} const " . strtoupper($constant->getName()) . " = " . $constant->getValueType($constant->getDefault()) . ";\n");
            }
        }
        return implode("\n", $data);
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

    /**
     * @return string
     */
    protected function renderProperty(): string
    {
        $data = [];
        if (!empty($this->getProperties())) {
            foreach ($this->getProperties() as $classProperty) {
                // if not comment, add default value type
                if (empty($classProperty->getComments()) && !is_null($classProperty->getDefault())) {
                    $classProperty->addComment("@var " . gettype($classProperty->getDefault()));
                }
                if (!empty($classProperty->getComments())) {
                    $data[] = $this->renderComment($classProperty->getComments(), 1);
                }
                $property = "{$this->getSpaces()}{$this->getScope($classProperty)} $" . $classProperty->getName();
                if (is_null($classProperty->getDefault())) {
                    $property .= ";";
                } else {
                    $property .= (" = " . $classProperty->getValueType($classProperty->getDefault()) . ";");
                }
                $data[] = $property . "\n";
            }
        }
        return implode("\n", $data);
    }

    /**
     * @return string
     */
    protected function renderMethod(): string
    {
        $data = [];
        if (!empty($this->getMethods())) {
            foreach ($this->getMethods() as $classMethod) {
                $params = [];
                if (!empty($classMethod->getParams())) {
                    foreach ($classMethod->getParams() as $classParams) {
                        $classParamName = "$" . $classParams->getName();
                        if (empty($classParams->getType()) && !empty($classParams->getDefault())) {
                            $classParams->setType($classMethod->valueType($classParams->getDefault()));
                        }
                        $classParam = '';
                        if (!empty($classParams->getType())) {
                            $classParam .= "{$classParams->getType()} ";
                        } else {
                            $classParams->setType("mixed");
                        }
                        $classParam .= $classParamName;
                        if ($classParams->getAssign()) {
                            $classParam .= (" = " . $classMethod->getValueType($classParams->getDefault()));
                        }
                        $params[] = $classParam;
                        $type = str_replace('?', 'null|', $classParams->getType());
                        $classMethod->addComment("@param {$type} {$classParamName} {$classParams->getComment()}");
                    }
                }
                $param = implode(", ", $params);

                $method = $this->getSpaces();
                if ($classMethod->getFinal()) {
                    $method .= "final";
                }
                $method .= "{$this->getScope($classMethod)} function {$classMethod->getName()}({$param})";
                if (!empty($classMethod->getReturn())) {
                    $method .= ": {$classMethod->getReturn()}";
                } else {
                    $classMethod->setReturn('mixed');
                }
                $classMethod->addComment("@return {$classMethod->getReturn()}");

                $data[] = $this->renderComment($classMethod->getComments(), 1);
                $data[] = $method;
                $data[] = "{$this->getSpaces()}{";
                if (empty($classMethod->getContent())) {
                    $classMethod->setContent("{$this->getSpaces(2)}// TODO: Implement {$classMethod->getName()}() method.");
                }
                $data[] = $classMethod->getContent();
                $data[] = "{$this->getSpaces()}}\n";
            }
        }
        return implode("\n", $data);
    }

    /**
     * @return string
     */
    protected function renderClass(): string
    {
        return implode("\n", array_filter([
            // class comment
            !empty($this->getComments()) ? $this->renderComment($this->getComments()) : "",
            // classname
            $this->renderClassname(),
            // start
            '{',
            // const
            $this->renderConst(),
            // properties
            $this->renderProperty(),
            // methods
            $this->renderMethod(),
            // end
            '}',
        ]));

    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return implode("\n\n", array_filter([
            // <?php
            "<?php",
            "declare(strict_types=1);",
            // namespace
            !empty($this->getNamespace()) ? "namespace {$this->getNamespace()};" : "",
            // uses
            $this->renderUses(),
            // class
            $this->renderClass(),
        ]));
    }
}
