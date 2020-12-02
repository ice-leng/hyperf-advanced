<?php

namespace App\Component\AntDesign\Column;

use Lengbin\Common\Component\BaseObject;

/**
 * 当前列值的枚举
 *
 * @package App\Component\AntDesign\Column
 */
class ValueEnum extends BaseObject
{
    /**
     * @var mixed
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * 渲染的状态
     * @var string
     */
    private $status = '';

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     *
     * @return ValueEnum
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return ValueEnum
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return ValueEnum
     */
    public function setStatus(string $status): ValueEnum
    {
        $this->status = $status;
        return $this;
    }
}
