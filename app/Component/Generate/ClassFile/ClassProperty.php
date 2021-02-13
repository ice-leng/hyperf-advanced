<?php

namespace App\Component\Generate\ClassFile;

class ClassProperty extends ClassBase
{
    /**
     * @var mixed
     */
    protected $default;

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     *
     * @return ClassProperty
     */
    public function setDefault($default): ClassProperty
    {
        $this->default = $default;
        return $this;
    }
}
