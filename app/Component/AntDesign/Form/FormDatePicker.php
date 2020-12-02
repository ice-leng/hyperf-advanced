<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Constant\Type\FormDateType;

class FormDatePicker extends BaseForm
{
    /**
     * 时间类型
     * @var FormDateType
     */
    private $type;

    /**
     *  双滑块模式
     * @var bool
     */
    private $range;

    /**
     * 设置初始取值。当 range 为 false 时，使用 string，否则用 [string, string]
     * @var string
     */
    private $defaultValue;

    /**
     * @return FormDateType
     */
    public function getType(): FormDateType
    {
        return $this->type;
    }

    /**
     * @param FormDateType $type
     *
     * @return FormDatePicker
     */
    public function setType(FormDateType $type): FormDatePicker
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRange(): bool
    {
        return $this->range;
    }

    /**
     * @param bool $range
     *
     * @return FormDatePicker
     */
    public function setRange(bool $range): FormDatePicker
    {
        $this->range = $range;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param string $defaultValue
     *
     * @return FormDatePicker
     */
    public function setDefaultValue(string $defaultValue): FormDatePicker
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

}
