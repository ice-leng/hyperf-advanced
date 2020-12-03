<?php

namespace App\Component\AntDesign\Config;

use Lengbin\Common\Component\BaseObject;

/**
 * 页 配置
 * @package App\Component\AntDesign\Config
 */
class PageConfig extends BaseObject
{
    /**
     * 查询按钮的PageConfig文本
     * @var string
     */
    private $searchText;

    /**
     * 重置按钮的文本
     * @var string
     */
    private $resetText;

    /**
     * 提交按钮的文本
     * @var string
     */
    private $submitText;

    /**
     * 标签的宽度
     * @var string|int
     */
    private $labelWidth;

    /**
     * 配置搜索框在该行所占的栅格, 范围 1 - 24
     * @var int
     */
    private $span;

    /**
     * 默认是否收起
     * @var bool
     */
    private $defaultCollapsed;

    /**
     * 是否收起
     * @var bool
     */
    private $collapsed;

    /**
     * @return string
     */
    public function getSearchText(): string
    {
        return $this->searchText;
    }

    /**
     * @param string $searchText
     *
     * @return PageConfig
     */
    public function setSearchText(string $searchText): PageConfig
    {
        $this->searchText = $searchText;
        return $this;
    }

    /**
     * @return string
     */
    public function getResetText(): string
    {
        return $this->resetText;
    }

    /**
     * @param string $resetText
     *
     * @return PageConfig
     */
    public function setResetText(string $resetText): PageConfig
    {
        $this->resetText = $resetText;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubmitText(): string
    {
        return $this->submitText;
    }

    /**
     * @param string $submitText
     *
     * @return PageConfig
     */
    public function setSubmitText(string $submitText): PageConfig
    {
        $this->submitText = $submitText;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getLabelWidth()
    {
        return $this->labelWidth;
    }

    /**
     * @param int|string $labelWidth
     *
     * @return PageConfig
     */
    public function setLabelWidth($labelWidth)
    {
        $this->labelWidth = $labelWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpan(): int
    {
        return $this->span;
    }

    /**
     * @param int $span
     *
     * @return PageConfig
     */
    public function setSpan(int $span): PageConfig
    {
        $this->span = $span;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefaultCollapsed(): bool
    {
        return $this->defaultCollapsed;
    }

    /**
     * @param bool $defaultCollapsed
     *
     * @return PageConfig
     */
    public function setDefaultCollapsed(bool $defaultCollapsed): PageConfig
    {
        $this->defaultCollapsed = $defaultCollapsed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCollapsed(): bool
    {
        return $this->collapsed;
    }

    /**
     * @param bool $collapsed
     *
     * @return PageConfig
     */
    public function setCollapsed(bool $collapsed): PageConfig
    {
        $this->collapsed = $collapsed;
        return $this;
    }
}
