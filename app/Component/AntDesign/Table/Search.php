<?php

namespace App\Component\AntDesign\Table;

use App\Component\AntDesign\Errors\TableError;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Hyperf\Common\Exception\BusinessException;

class Search extends BaseObject
{
    /**
     * 查询按钮的文本
     * @var string
     */
    public $searchText = '查询';

    /**
     * 重置按钮的文本
     * @var string
     */
    public $resetText = '重置';

    /**
     * 提交按钮的文本
     * @var string
     */
    public $submitText = '提交';

    /**
     * 标签的宽度
     * @var string|int
     */
    public $labelWidth = 'auto';

    /**
     * 配置搜索框在该行所占的栅格, 范围 1 - 24
     * @var int|string
     */
    public $span = 'ColConfig';

    /**
     * 默认是否收起
     * @var bool
     */
    public $defaultCollapsed = true;

    public function init()
    {
        // span
        if ((is_int($this->span) && $this->span < 1) || $this->span > 24) {
            throw new BusinessException(TableError::ERROR_ANTDESIGN_TABLE_SPAN_RANGE_ERROR);
        }
    }
}
