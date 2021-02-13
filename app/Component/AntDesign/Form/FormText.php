<?php

namespace App\Component\AntDesign\Form;

class FormText extends BaseForm
{
    /**
     * 是否有边框
     * @var bool
     */
    protected $bordered;

    /**
     * 可以点击清除图标删除内容
     * @var bool
     */
    protected $allowClear;

    /**
     * 是否展示字数
     * @var bool
     */
    protected $showCount;

    /**
     * @return bool
     */
    public function getBordered(): bool
    {
        return $this->bordered;
    }

    /**
     * @param bool $bordered
     *
     * @return FormText
     */
    public function setBordered(bool $bordered): FormText
    {
        $this->bordered = $bordered;
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
     * @return FormText
     */
    public function setAllowClear(bool $allowClear): FormText
    {
        $this->allowClear = $allowClear;
        return $this;
    }

    /**
     * @return bool
     */
    public function getShowCount(): bool
    {
        return $this->showCount;
    }

    /**
     * @param bool $showCount
     *
     * @return FormText
     */
    public function setShowCount(bool $showCount): FormText
    {
        $this->showCount = $showCount;
        return $this;
    }
}
