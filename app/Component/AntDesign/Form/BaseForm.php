<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Constant\Type\WidthType;
use Lengbin\Common\Component\BaseObject;

/**
 * 表单基础类型
 * @package App\Component\AntDesign\Form
 */
class BaseForm extends BaseObject
{
    /**
     * 属性名
     * @var string
     */
    protected $name;

    /**
     * 输入框名称
     * @var string
     */
    protected $label = '';

    /**
     * 提示字
     * @var string
     */
    protected $placeholder = '';

    /**
     * 宽度
     * @var WidthType
     */
    protected $width;

    /**
     * 表单提交时该输入框的校验规则
     * @var Rules[]
     */
    protected $rules;

    /**
     *    不可选中
     * @var bool
     */
    protected $disabled;

    /**
     * 表单类型
     * @var string
     */
    protected $inputType;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BaseForm
     */
    public function setName(string $name): BaseForm
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return BaseForm
     */
    public function setLabel(string $label): BaseForm
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     *
     * @return BaseForm
     */
    public function setPlaceholder(string $placeholder): BaseForm
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return WidthType
     */
    public function getWidth(): WidthType
    {
        return $this->width;
    }

    /**
     * @param WidthType $width
     *
     * @return BaseForm
     */
    public function setWidth(WidthType $width): BaseForm
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return Rules[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param Rules[] $rules
     *
     * @return BaseForm
     */
    public function setRules(array $rules): BaseForm
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     *
     * @return BaseForm
     */
    public function setDisabled(bool $disabled): BaseForm
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function toArray(?object $object = null): array
    {
        $this->getName();
        return parent::toArray($object);
    }

    /**
     * @return string
     */
    public function getInputType(): string
    {
        return $this->inputType;
    }

    /**
     * @param string $inputType
     *
     * @return BaseForm
     */
    public function setInputType(string $inputType): BaseForm
    {
        $this->inputType = $inputType;
        return $this;
    }
}
