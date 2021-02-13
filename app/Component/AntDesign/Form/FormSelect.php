<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Column\ValueEnum;
use App\Component\AntDesign\Column\ValueEnumType;
use App\Component\AntDesign\Constant\Type\FormSelectModeType;
use App\Component\AntDesign\Constant\Type\SizeType;

/**
 * 下拉
 * @package App\Component\AntDesign\Form
 */
class FormSelect extends BaseForm
{
    /**
     * 当前列值的枚举
     * @var ValueEnum[]
     * @see valueType
     */
    private $valueEnum;

    /**
     *    设置 Select 的模式为多选或标签
     * @var FormSelectModeType
     */
    private $mode;

    /**
     * 设置弹窗滚动高度
     * @var int
     */
    private $listHeight;

    /**
     *    选择框大小
     * @var SizeType
     */
    private $size;

    /**
     * 使单选模式可搜索
     * @var bool
     */
    private $showSearch;

    /**
     * 可以点击清除图标删除内容
     * @var bool
     */
    private $allowClear;

    /**
     * 是否在选中项后清空搜索框，只在 mode 为 multiple 或 tags 时有效
     * @var bool
     */
    private $autoClearSearchValue;

    /**
     *    是否有边框
     * @var bool
     */
    private $bordered;

    /**
     * 是否默认展开下拉菜单
     * 是否默认高亮第一个选项
     * @var bool
     */
    private $defaultActiveFirstOption;

    /**
     * @var bool
     */
    private $defaultOpen;

    /**
     * @return ValueEnum[]
     */
    public function getValueEnum(): array
    {
        return $this->valueEnum;
    }

    /**
     * @param ValueEnum[] $valueEnum
     *
     * @return FormSelect
     */
    public function setValueEnum(array $valueEnum): FormSelect
    {
        $this->valueEnum = $valueEnum;
        return $this;
    }

    /**
     * @return FormSelectModeType
     */
    public function getMode(): FormSelectModeType
    {
        return $this->mode;
    }

    /**
     * @param FormSelectModeType $mode
     *
     * @return FormSelect
     */
    public function setMode(FormSelectModeType $mode): FormSelect
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return int
     */
    public function getListHeight(): int
    {
        return $this->listHeight;
    }

    /**
     * @param int $listHeight
     *
     * @return FormSelect
     */
    public function setListHeight(int $listHeight): FormSelect
    {
        $this->listHeight = $listHeight;
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
     * @return FormSelect
     */
    public function setSize(SizeType $size): FormSelect
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return bool
     */
    public function getShowSearch(): bool
    {
        return $this->showSearch;
    }

    /**
     * @param bool $showSearch
     *
     * @return FormSelect
     */
    public function setShowSearch(bool $showSearch): FormSelect
    {
        $this->showSearch = $showSearch;
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
     * @return FormSelect
     */
    public function setAllowClear(bool $allowClear): FormSelect
    {
        $this->allowClear = $allowClear;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAutoClearSearchValue(): bool
    {
        return $this->autoClearSearchValue;
    }

    /**
     * @param bool $autoClearSearchValue
     *
     * @return FormSelect
     */
    public function setAutoClearSearchValue(bool $autoClearSearchValue): FormSelect
    {
        $this->autoClearSearchValue = $autoClearSearchValue;
        return $this;
    }

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
     * @return FormSelect
     */
    public function setBordered(bool $bordered): FormSelect
    {
        $this->bordered = $bordered;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDefaultActiveFirstOption(): bool
    {
        return $this->defaultActiveFirstOption;
    }

    /**
     * @param bool $defaultActiveFirstOption
     *
     * @return FormSelect
     */
    public function setDefaultActiveFirstOption(bool $defaultActiveFirstOption): FormSelect
    {
        $this->defaultActiveFirstOption = $defaultActiveFirstOption;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDefaultOpen(): bool
    {
        return $this->defaultOpen;
    }

    /**
     * @param bool $defaultOpen
     *
     * @return FormSelect
     */
    public function setDefaultOpen(bool $defaultOpen): FormSelect
    {
        $this->defaultOpen = $defaultOpen;
        return $this;
    }

}
