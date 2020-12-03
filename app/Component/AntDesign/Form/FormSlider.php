<?php

namespace App\Component\AntDesign\Form;

class FormSlider extends BaseForm
{
    /**
     *    双滑块模式
     * @var bool
     */
    private $range;

    /**
     * 设置初始取值。当 range 为 false 时，使用 number，否则用 [number, number]
     * @var float|float[]
     */
    private $defaultValue;

    /**
     * 最大值
     * @var float|int
     */
    private $max;

    /**
     *    最小值
     * @var float|int
     */
    private $min;

    /**
     * 值为 true 时，Tooltip 将会始终显示；否则始终不显示，哪怕在拖拽及移入时
     * @var bool
     */
    private $tooltipVisible;

    /**
     * @return bool
     */
    public function getRange(): bool
    {
        return $this->range;
    }

    /**
     * @param bool $range
     *
     * @return FormSlider
     */
    public function setRange(bool $range): FormSlider
    {
        $this->range = $range;
        return $this;
    }

    /**
     * @return float|float[]
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param float|float[] $defaultValue
     *
     * @return FormSlider
     */
    public function setDefaultValue($defaultValue): FormSlider
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param float|int $max
     *
     * @return FormSlider
     */
    public function setMax($max): FormSlider
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param float|int $min
     *
     * @return FormSlider
     */
    public function setMin($min): FormSlider
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return bool
     */
    public function getTooltipVisible(): bool
    {
        return $this->tooltipVisible;
    }

    /**
     * @param bool $tooltipVisible
     *
     * @return FormSlider
     */
    public function setTooltipVisible(bool $tooltipVisible): FormSlider
    {
        $this->tooltipVisible = $tooltipVisible;
        return $this;
    }

}
