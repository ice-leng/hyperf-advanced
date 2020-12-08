<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

class ClassBase extends BaseObject
{
    /**
     * @var bool
     */
    protected $static = false;

    /**
     * @var bool
     */
    protected $private = false;

    /**
     * @var bool
     */
    protected $protected = false;

    /**
     * @var bool
     */
    protected $public = true;

    /**
     * @var string
     */
    protected $comment = '';

    /**
     * @var string
     */
    protected $name;

    /**
     * @return bool
     */
    public function getStatic(): bool
    {
        return $this->static;
    }

    /**
     * @param bool $static
     *
     * @return ClassBase
     */
    public function setStatic(bool $static = true): ClassBase
    {
        $this->static = $static;
        return $this;
    }

    /**
     * @return bool
     */
    public function getPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @param bool $private
     *
     * @return ClassBase
     */
    public function setPrivate(bool $private = true): ClassBase
    {
        $this->private = $private;
        if ($private === true) {
            $this->setPublic(false);
            $this->setProtected(false);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getProtected(): bool
    {
        return $this->protected;
    }

    /**
     * @param bool $protected
     *
     * @return ClassBase
     */
    public function setProtected(bool $protected = true): ClassBase
    {
        $this->protected = $protected;
        if ($protected === true) {
            $this->setPublic(false);
            $this->setPrivate(false);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     *
     * @return ClassBase
     */
    public function setPublic(bool $public = true): ClassBase
    {
        $this->public = $public;
        if ($public === true) {
            $this->setProtected(false);
            $this->setPrivate(false);
        }
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
     * @return ClassBase
     */
    public function setComment(string $comment): ClassBase
    {
        $this->comment = $comment;
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
     * @return ClassBase
     */
    public function setName(string $name): ClassBase
    {
        $this->name = $name;
        return $this;
    }
}