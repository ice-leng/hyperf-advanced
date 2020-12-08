<?php

namespace App\Component\Generate;

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

}
