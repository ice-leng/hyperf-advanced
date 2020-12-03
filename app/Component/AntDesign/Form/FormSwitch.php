<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Constant\Type\SizeType;

class FormSwitch extends BaseForm
{
    /**
     * 初始是否选中
     * @var bool
     */
    private $defaultChecked;

    /**
     *    选择框大小
     * @var SizeType
     */
    private $size;

    /**
     * 左边 字
     * @var string
     */
    private $checkedChildren;

    /**
     * 右边 字
     * @var string
     */
    private $unCheckedChildren;

    /**
     * @return bool
     */
    public function getDefaultChecked(): bool
    {
        return $this->defaultChecked;
    }

    /**
     * @param bool $defaultChecked
     *
     * @return FormSwitch
     */
    public function setDefaultChecked(bool $defaultChecked): FormSwitch
    {
        $this->defaultChecked = $defaultChecked;
        return $this;
    }

    /**
     * @return SizeType
     */
    public function getSize(): SizeType
    {
        return $this->size;
    }

    /**
     * @param SizeType $size
     *
     * @return FormSwitch
     */
    public function setSize(SizeType $size): FormSwitch
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckedChildren(): string
    {
        return $this->checkedChildren;
    }

    /**
     * @param string $checkedChildren
     *
     * @return FormSwitch
     */
    public function setCheckedChildren(string $checkedChildren): FormSwitch
    {
        $this->checkedChildren = $checkedChildren;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnCheckedChildren(): string
    {
        return $this->unCheckedChildren;
    }

    /**
     * @param string $unCheckedChildren
     *
     * @return FormSwitch
     */
    public function setUnCheckedChildren(string $unCheckedChildren): FormSwitch
    {
        $this->unCheckedChildren = $unCheckedChildren;
        return $this;
    }

}
