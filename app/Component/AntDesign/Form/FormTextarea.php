<?php

namespace App\Component\AntDesign\Form;

/**
 * 多行文本域
 * @package App\Component\AntDesign\Form
 */
class FormTextarea extends FormText
{
    /**
     * 自适应内容高度，可设置为 true | false 或对象：{ minRows: 2, maxRows: 6 }
     * @var bool|AutoSize
     */
    private $autoSize;

    /**
     * 输入框默认内容
     * @var string
     */
    private $defaultValue;

    /**
     * 内容最大长度
     * @var int
     */
    private $maxLength;

    /**
     * @return AutoSize|bool
     */
    public function getAutoSize()
    {
        return $this->autoSize;
    }

    /**
     * @param AutoSize|bool $autoSize
     *
     * @return FormTextarea
     */
    public function setAutoSize($autoSize)
    {
        $this->autoSize = $autoSize;
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
     * @return FormTextarea
     */
    public function setDefaultValue(string $defaultValue): FormTextarea
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     *
     * @return FormTextarea
     */
    public function setMaxLength(int $maxLength): FormTextarea
    {
        $this->maxLength = $maxLength;
        return $this;
    }
}
