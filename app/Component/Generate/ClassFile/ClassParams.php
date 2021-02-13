<?php

namespace App\Component\Generate\ClassFile;

use Lengbin\Common\Component\BaseObject;

class ClassParams extends BaseObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $type;

    /**
     * @var string
     */
    private $comment = '';

    /**
     * @var mixed
     */
    private $default;

    /**
     * 是否 赋值
     * @var bool
     */
    private $assign = false;

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     *
     * @return ClassParams
     */
    public function setDefault($default): ClassParams
    {
        $this->setAssign(true);
        $this->default = $default;
        return $this;
    }

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
     * @return ClassParams
     */
    public function setName(string $name): ClassParams
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return ClassParams
     */
    public function setType($type): ClassParams
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return ClassParams
     */
    public function setComment(string $comment): ClassParams
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAssign(): bool
    {
        return $this->assign;
    }

    /**
     * @param bool $assign
     *
     * @return ClassParams
     */
    public function setAssign(bool $assign): ClassParams
    {
        $this->assign = $assign;
        return $this;
    }
}
