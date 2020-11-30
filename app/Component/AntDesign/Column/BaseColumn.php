<?php

namespace App\Component\AntDesign\Column;

use App\Component\AntDesign\Constant\Status\ProgressTypeStatus;
use App\Component\AntDesign\Constant\Status\ValueEnumTypeStatus;
use App\Component\AntDesign\Constant\Type\ValueType;
use Lengbin\Common\Component\BaseObject;

/**
 * Class Column
 * @package App\Component\AntDesign
 * @document https://github.com/coderlfm/CMS
 */
class BaseColumn extends BaseObject
{
    /**
     * 后端返回数据key
     * @var string
     */
    private $dataIndex;

    /**
     * 表格/表单标题名
     * @var string
     */
    private $title;

    /**
     * 搜索时请求服务器的key名
     * @var string
     */
    private $key;

    /**
     * 是否拷贝
     * @var bool
     */
    private $copyable;

    /**
     * 超出换行
     * @var bool
     */
    private $ellipsis;

    /**
     * 是否展示在搜索框,默认值true
     * @var bool
     */
    private $search;

    /**
     * 值类型, 默认值text
     * @var ValueType
     */
    private $valueType;

    /**
     * 表头筛选项,默认值 true 当值为 true 时, 自动使用 valueEnum 生成   类型: boolean | object[]
     * @var bool
     */
    private $filters;

    /**
     * 当前列值的枚举
     * @var ValueEnum[]
     * @see valueType
     */
    private $valueEnum;

    /**
     * 会在 title 之后展示一个 icon，hover 之后提示一些信息
     * @var string
     */
    private $tooltip;

    /**
     * 宽度
     * @var string
     */
    private $width;

    /**
     * 在查询表单中不展示此项
     * @var bool
     */
    private $hideInSearch;

    /**
     * 在 Table 中不展示此列
     * @var bool
     */
    private $hideInTable;

    /**
     * valueType为 select | radio | radioButton | checkbox 时可设置在表单搜索时的默认值
     * select |checkbox 为数组 ['string'],单选为 string
     * @var string | array
     */
    private $initialValue;

    /**
     * @return bool
     */
    public function getCopyable(): bool
    {
        return $this->copyable;
    }

    /**
     * @param bool $copyable
     *
     * @return BaseColumn
     */
    public function setCopyable(bool $copyable): BaseColumn
    {
        $this->copyable = $copyable;
        return $this;
    }

    /**
     * @return bool
     */
    public function getEllipsis(): bool
    {
        return $this->ellipsis;
    }

    /**
     * @param bool $ellipsis
     *
     * @return BaseColumn
     */
    public function setEllipsis(bool $ellipsis): BaseColumn
    {
        $this->ellipsis = $ellipsis;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSearch(): bool
    {
        return $this->search;
    }

    /**
     * @param bool $search
     *
     * @return BaseColumn
     */
    public function setSearch(bool $search): BaseColumn
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @return string
     */
    public function getValueType(): string
    {
        return $this->valueType;
    }

    /**
     * @param string $valueType
     *
     * @return BaseColumn
     */
    public function setValueType(string $valueType): BaseColumn
    {
        $this->valueType = $valueType;
        return $this;
    }

    /**
     * @return bool
     */
    public function getFilters(): bool
    {
        return $this->filters;
    }

    /**
     * @param bool $filters
     *
     * @return BaseColumn
     */
    public function setFilters(bool $filters): BaseColumn
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataIndex(): string
    {
        return $this->dataIndex;
    }

    /**
     * @param string $dataIndex
     *
     * @return BaseColumn
     */
    public function setDataIndex(string $dataIndex): BaseColumn
    {
        $this->dataIndex = $dataIndex;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return BaseColumn
     */
    public function setTitle(string $title): BaseColumn
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return BaseColumn
     */
    public function setKey(string $key): BaseColumn
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getTooltip(): string
    {
        return $this->tooltip;
    }

    /**
     * @param string $tooltip
     *
     * @return BaseColumn
     */
    public function setTooltip(string $tooltip): BaseColumn
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * @param string $width
     *
     * @return BaseColumn
     */
    public function setWidth(string $width): BaseColumn
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHideInSearch(): bool
    {
        return $this->hideInSearch;
    }

    /**
     * @param bool $hideInSearch
     *
     * @return BaseColumn
     */
    public function setHideInSearch(bool $hideInSearch): BaseColumn
    {
        $this->hideInSearch = $hideInSearch;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHideInTable(): bool
    {
        return $this->hideInTable;
    }

    /**
     * @param bool $hideInTable
     *
     * @return BaseColumn
     */
    public function setHideInTable(bool $hideInTable): BaseColumn
    {
        $this->hideInTable = $hideInTable;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getInitialValue()
    {
        return $this->initialValue;
    }

    /**
     * @param array|string $initialValue
     *
     * @return BaseColumn
     */
    public function setInitialValue($initialValue): BaseColumn
    {
        $this->initialValue = $initialValue;
        return $this;
    }

    /**
     * @return array
     */
    public function getValueEnum(): array
    {
        return $this->valueEnum;
    }

    /**
     * @param ValueEnum[] $valueEnum
     *
     * @return BaseColumn
     */
    public function setValueEnum(array $valueEnum): BaseColumn
    {
        $this->valueEnum = $valueEnum;
        return $this;
    }

    public function init()
    {
        if ($this->valueType->getValue() === ValueType::PROGRESS) {
            $progress = [];
            foreach ($this->getValueEnum() as $item) {
                $progress[$item->getKey()] = [
                    'text'   => $item->getValue(),
                    'status' => $item->getStatus() !== '' ? ProgressTypeStatus::byValue($item->getStatus())->getValue() : $item->getStatus(),
                ];
            }
            $this->valueEnum = $progress;
        }

        if (in_array($this->valueType->getValue(), [
            ValueType::SELECT,
            ValueType::CHECKBOX,
            ValueType::RADIO,
            ValueType::RADIO_BUTTON,
        ], true)) {
            $drops = [];
            foreach ($this->getValueEnum() as $item) {
                $drops[$item->getKey()] = [
                    'text'   => $item->getValue(),
                    'status' => $item->getStatus() !== '' ? ValueEnumTypeStatus::byValue($item->getStatus())->getValue() : $item->getStatus(),
                ];
            }
            $this->valueEnum = $drops;

            $initValue = $this->getInitialValue();
            if (in_array($this->valueType->getValue(), [ValueType::SELECT, ValueType::CHECKBOX,], true) && !is_array($initValue)) {
                $this->setInitialValue([$initValue]);
            }
        }
    }
}
