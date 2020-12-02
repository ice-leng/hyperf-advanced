<?php

namespace App\Component\AntDesign\Column;

use App\Component\AntDesign\Constant\Type\ValueType;
use Lengbin\Common\Component\BaseObject;

/**
 * 基础 列类
 * @package App\Component\AntDesign
 * @see     https://github.com/coderlfm/CMS
 */
class BaseColumn extends BaseObject
{
    /**
     * 后端返回数据key
     * @var string
     */
    protected $dataIndex;

    /**
     * 表格/表单标题名
     * @var string
     */
    protected $title;

    /**
     * 搜索时请求服务器的key名
     * @var string
     */
    protected $key;

    /**
     * 是否拷贝
     * @var bool
     */
    protected $copyable;

    /**
     * 超出换行
     * @var bool
     */
    protected $ellipsis;

    /**
     * 是否展示在搜索框,默认值true
     * @var bool
     */
    protected $search;

    /**
     * 值类型, 默认值text
     * @var ValueType
     */
    protected $valueType;

    /**
     * 表头筛选项,默认值 true 当值为 true 时, 自动使用 valueEnum 生成   类型: boolean | object[]
     * @var bool
     */
    protected $filters;

    /**
     * 当前列值的枚举
     * @var ValueEnum[]
     * @see valueType
     */
    protected $valueEnum;

    /**
     * 会在 title 之后展示一个 icon，hover 之后提示一些信息
     * @var string
     */
    protected $tooltip;

    /**
     * 宽度
     * @var string
     */
    protected $width;

    /**
     * 在查询表单中不展示此项
     * @var bool
     */
    protected $hideInSearch;

    /**
     * 在 Table 中不展示此列
     * @var bool
     */
    protected $hideInTable;

    /**
     * valueType为 select | radio | radioButton | checkbox 时可设置在表单搜索时的默认值
     * select |checkbox 为数组 ['string'],单选为 string
     * @var string|array
     */
    protected $initialValue;

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
     * @return ValueType
     */
    public function getValueType(): ValueType
    {
        return $this->valueType;
    }

    /**
     * @param ValueType $valueType
     *
     * @return BaseColumn
     */
    public function setValueType(ValueType $valueType): BaseColumn
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

    protected function check(): void
    {
        // 必填项验证
        $this->getDataIndex();
        // 进度条
        if ($this->valueType->getValue() === ValueType::PROGRESS) {
            $progress = [];
            foreach ($this->getValueEnum() as $item) {
                $progress[$item->getKey()] = new ProgressType([
                    'text'   => $item->getValue(),
                    'status' => $item->getStatus(),
                ]);
            }
            $this->valueEnum = $progress;
        }

        // 具有 drop 属性
        if (in_array($this->valueType->getValue(), [
            ValueType::SELECT,
            ValueType::CHECKBOX,
            ValueType::RADIO,
            ValueType::RADIO_BUTTON,
        ], true)) {
            $drops = [];
            foreach ($this->getValueEnum() as $item) {
                $drops[$item->getKey()] = new ValueEnumType([
                    'text'   => $item->getValue(),
                    'status' => $item->getStatus(),
                ]);
            }
            $this->valueEnum = $drops;

            // 如果是 select 或者 checkbox 默认为数组
            $initValue = $this->getInitialValue();
            if (in_array($this->valueType->getValue(), [ValueType::SELECT, ValueType::CHECKBOX,], true) && !is_array($initValue)) {
                $this->setInitialValue([$initValue]);
            }
        }
    }

    public function toArray(?object $object = null): array
    {
        $this->check();
        return parent::toArray($object); // TODO: Change the autogenerated stub
    }
}
