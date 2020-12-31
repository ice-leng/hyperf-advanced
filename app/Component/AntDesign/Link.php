<?php

namespace App\Component\AntDesign;

use App\Component\AntDesign\Constant\Status\ValueEnumTypeStatus;
use App\Component\AntDesign\Constant\Type\FormMethod;
use App\Component\AntDesign\Constant\Type\LinkTarget;
use App\Component\AntDesign\Constant\Type\LinkType;
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
     * @var ValueEnumTypeStatus
     */
    private $status;

    /**
     * @var FormMethod
     */
    private $method;

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
}
