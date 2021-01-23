<?php

namespace App\Component\Generate\Build\Collection;

use Lengbin\Common\Component\BaseObject;

class BaseBuildCollection extends BaseObject
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $classname;

    /**
     * @var string
     */
    protected $file;

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     *
     * @return BaseBuildCollection
     */
    public function setClass(string $class): BaseBuildCollection
    {
        $this->class = $class;
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
     * @return BaseBuildCollection
     */
    public function setClassname(string $classname): BaseBuildCollection
    {
        $this->classname = $classname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     *
     * @return BaseBuildCollection
     */
    public function setFile(string $file): BaseBuildCollection
    {
        $this->file = $file;
        return $this;
    }
}
