<?php

namespace App\Component\AntDesign\Form;

class FormRate extends BaseForm
{
    /**
     * 自定义字符
     * @var string
     */
    private $character;

    /**
     * 是否允许再次点击后清除
     * @var bool
     */
    private $allowClear;

    /**
     * 是否允许半选
     * @var bool
     */
    private $allowHalf;

    /**
     * star 总数
     * @var int
     */
    private $count;

    /**
     * @var int|float
     */
    private $defaultValue;

    /**
     * @return string
     */
    public function getCharacter(): string
    {
        return $this->character;
    }

    /**
     * @param string $character
     *
     * @return FormRate
     */
    public function setCharacter(string $character): FormRate
    {
        $this->character = $character;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowClear(): bool
    {
        return $this->allowClear;
    }

    /**
     * @param bool $allowClear
     *
     * @return FormRate
     */
    public function setAllowClear(bool $allowClear): FormRate
    {
        $this->allowClear = $allowClear;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowHalf(): bool
    {
        return $this->allowHalf;
    }

    /**
     * @param bool $allowHalf
     *
     * @return FormRate
     */
    public function setAllowHalf(bool $allowHalf): FormRate
    {
        $this->allowHalf = $allowHalf;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return FormRate
     */
    public function setCount(int $count): FormRate
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param float|int $defaultValue
     *
     * @return FormRate
     */
    public function setDefaultValue($defaultValue): FormRate
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }
}
