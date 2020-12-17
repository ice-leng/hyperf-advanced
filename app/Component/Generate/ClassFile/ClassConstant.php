<?php

namespace App\Component\Generate\ClassFile;

class ClassConstant extends ClassBase
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
     * @return ClassBase
     */
    public function setDefault($default): ClassBase
    {
        $this->default = $default;
        return $this;
    }
}
