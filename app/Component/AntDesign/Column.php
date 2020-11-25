<?php

namespace App\Component\AntDesign;

use App\Component\AntDesign\Errors\TableError;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Hyperf\Common\Exception\BusinessException;
use stdClass;

class Column extends BaseObject
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
     * 列的小提示字
     * @var string|null
     */
    private $tip;

    /**
     * 是否拷贝
     * @var bool
     */
    private $copyable = false;

    /**
     * 超出换行
     * @var bool
     */
    private $ellipsis = true;

    /**
     * 是否展示在搜索框,默认值false
     * @var bool
     */
    private $search = false;

    /**
     * 值类型, 默认值text
     * @var string
     */
    private $valueType = 'text';

    /**
     * 表头筛选项,默认值 true 当值为 true 时, 自动使用 valueEnum 生成   类型: boolean | object[]
     * @var bool
     */
    private $filters = true;

    /**
     * 当前列值的枚举
     * @var object|array
     */
    private $valueEnum = [];

    /**
     * @var string[]
     */
    private $valueTypeAllows = [
        'money',        //转化值为金额	¥10, 000.26
        'date',         //日期	2019 - 11 - 16
        'dateRange',    //日期区间	2019 - 11 - 16 2019 - 11 - 18
        'dateTime',     //日期和时间	2019 - 11 - 16 12: 50: 00
        'dateTimeRange', //日期和时间区间	2019 - 11 - 16 12: 50: 00 2019 - 11 - 18 12: 50: 00
        'time',          //时间	12: 50: 00
        'option',        //操作项，会自动增加 marginRight，只支持一个数组, 表单中会自动忽略[<a>操作a</a>, <a>操作b</a>]
        'text',          //默认值，不做任何处理 -
        'select',       //选择 -
        'textarea',     //与 text 相同， form 转化时会转为 textarea 组件 -
        'index',        //序号列 -
        'indexBorder',  //带 border 的序号列 -
        'progress',     //进度条 -
        'digit',        //格式化数字展示，form 转化时会转为 inputNumber -
        'percent',      //百分比 + 1.12
        'code',         //代码块	const a = b
        'avatar',       //头像	展示一个头像
        'password',     //密码框	密码相关的展示
    ];

    public function init()
    {
        parent::init();
        if (!in_array($this->getValueType(), $this->valueTypeAllows)) {
            throw new BusinessException(TableError::ERROR_ANTDESIGN_COLUMN_VALUETYPE_NOT_SUPPORT);
        }
    }

    /**
     * @return mixed
     */
    public function getValueEnum()
    {
        return is_array($this->valueEnum) ? new stdClass() : $this->valueEnum;
    }

    /**
     * @param array $valueEnum
     *
     * @return Column
     */
    public function setValueEnum(array $valueEnum): Column
    {
        $this->valueEnum = $valueEnum;
        return $this;
    }

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
     * @return Column
     */
    public function setCopyable(bool $copyable): Column
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
     * @return Column
     */
    public function setEllipsis(bool $ellipsis): Column
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
     * @return Column
     */
    public function setSearch(bool $search): Column
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
     * @return Column
     */
    public function setValueType(string $valueType): Column
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
     * @return Column
     */
    public function setFilters(bool $filters): Column
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
     * @return Column
     */
    public function setDataIndex(string $dataIndex): Column
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
     * @return Column
     */
    public function setTitle(string $title): Column
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTip(): ?string
    {
        return $this->tip;
    }

    /**
     * @param string|null $tip
     *
     * @return Column
     */
    public function setTip(?string $tip): Column
    {
        $this->tip = $tip;
        return $this;
    }
}
