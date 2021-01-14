<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildControllerConfig extends BaseObject
{
    /**
     * 路由前缀
     * @var string
     */
    private $prefix;

    /**
     * 继承
     * @var string
     */
    private $inheritance;

    /**
     * 使用  命名空间
     * @var array
     */
    private $uses = [];

    /**
     * 控制器 服务数学 - 回调
     * @var callable
     */
    private $properties;

    /**
     * 注解解析
     * @var string
     */
    private $annotationValidateParse;

    /**
     * @var callable
     */
    private $comment;

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
     * @return BuildControllerConfig
     */
    public function setInheritance(string $inheritance): BuildControllerConfig
    {
        $this->inheritance = $inheritance;
        return $this;
    }

    /**
     * @return callable
     */
    public function getProperties(): callable
    {
        return $this->properties;
    }

    /**
     * @param callable|null $properties
     *
     * @return BuildControllerConfig
     */
    public function setProperties(?callable $properties): BuildControllerConfig
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnnotationValidateParse(): string
    {
        return $this->annotationValidateParse;
    }

    /**
     * @param string $annotationValidateParse
     *
     * @return BuildControllerConfig
     */
    public function setAnnotationValidateParse(string $annotationValidateParse): BuildControllerConfig
    {
        $this->annotationValidateParse = $annotationValidateParse;
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
     * @return BuildControllerConfig
     */
    public function setUses(array $uses): BuildControllerConfig
    {
        $this->uses = $uses;
        return $this;
    }

    /**
     * @return callable
     */
    public function getComment(): callable
    {
        return $this->comment;
    }

    /**
     * @param callable $comment
     *
     * @return BuildControllerConfig
     */
    public function setComment(callable $comment): BuildControllerConfig
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     *
     * @return BuildControllerConfig
     */
    public function setPrefix(string $prefix): BuildControllerConfig
    {
        $this->prefix = $prefix;
        return $this;
    }
}
