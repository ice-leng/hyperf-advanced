<?php

namespace App\Component\AntDesign\Link;

use App\Component\AntDesign\Constant\Status\ValueEnumTypeStatus;
use App\Component\AntDesign\Constant\Type\LinkTarget;
use App\Component\AntDesign\Constant\Type\LinkType;
use App\Component\AntDesign\Form\Form;
use Lengbin\Common\Component\BaseObject;

class Link extends BaseObject
{
    /**
     * 名称
     * @var string
     */
    private $name;

    /**
     * path
     * @var string
     */
    private $path;

    /**
     * @var LinkTarget
     */
    private $target;

    /**
     * 类型
     * @var LinkType
     */
    private $type;

    /**
     * 显示 状态
     * @var ValueEnumTypeStatus
     */
    private $status;

    /**
     * 小图标
     * @var string
     */
    private $icon = '';

    /**
     * 配置显示内容
     * @var string
     */
    private $label = '';

    /**
     * 请求 数据
     * @var array
     */
    private $data = [];

    /**
     * 确认提示文字
     * @var string
     */
    private $tip = '';

    /**
     * @var Form
     */
    private $form;

    /**
     * 显示文字判断条件， 属性name失效
     * @var LinkCondition[]
     */
    private $condition;

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
     * @return Link
     */
    public function setName(string $name): Link
    {
        $this->name = $name;
        if (empty($this->label)) {
            $this->setLabel($name);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Link
     */
    public function setPath(string $path): Link
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return LinkTarget
     */
    public function getTarget(): LinkTarget
    {
        return $this->target;
    }

    /**
     * @param LinkTarget $target
     *
     * @return Link
     */
    public function setTarget(LinkTarget $target): Link
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return LinkType
     */
    public function getType(): LinkType
    {
        return $this->type;
    }

    /**
     * @param LinkType $type
     *
     * @return Link
     */
    public function setType(LinkType $type): Link
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return ValueEnumTypeStatus
     */
    public function getStatus(): ValueEnumTypeStatus
    {
        return $this->status;
    }

    /**
     * @param ValueEnumTypeStatus $status
     *
     * @return Link
     */
    public function setStatus(ValueEnumTypeStatus $status): Link
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return Link
     */
    public function setIcon(string $icon): Link
    {
        $this->icon = $icon;
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
     * @return Link
     */
    public function setLabel(string $label): Link
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return Link
     */
    public function setData(array $data): Link
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getTip(): string
    {
        return $this->tip;
    }

    /**
     * @param string $tip
     *
     * @return Link
     */
    public function setTip(string $tip): Link
    {
        $this->tip = $tip;
        return $this;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return Link
     */
    public function setForm(Form $form): Link
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return LinkCondition[]
     */
    public function getCondition(): array
    {
        return $this->condition;
    }

    /**
     * @param LinkCondition[] $condition
     *
     * @return Link
     */
    public function setCondition(array $condition): Link
    {
        $this->condition = $condition;
        return $this;
    }
}
