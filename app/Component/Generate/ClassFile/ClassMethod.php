<?php

namespace App\Component\Generate\ClassFile;

class ClassMethod extends ClassBase
{
    /**
     * @var bool
     */
    private $final = false;

    /**
     * @var ClassParams[]
     */
    private $params = [];

    /**
     * @var mixed
     */
    private $return;

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
     * @return ClassMethod
     */
    public function setFinal(bool $final = true): ClassMethod
    {
        $this->final = $final;
        return $this;
    }

    /**
     * @return ClassParams[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param ClassParams[] $params
     *
     * @return ClassMethod
     */
    public function setParams(array $params): ClassMethod
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param mixed $return
     *
     * @return ClassMethod
     */
    public function setReturn($return): ClassMethod
    {
        $this->return = $return;
        return $this;
    }

    /**
     * @param ClassParams $params
     *
     * @return $this
     */
    public function addParams(ClassParams $params): ClassMethod
    {
        $this->params[] = $params;
        return $this;
    }
}
