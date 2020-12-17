<?php

namespace App\Component\Generate\ClassFile;

use Lengbin\Common\Component\BaseObject;

/**
 * Class ClassBase
 */
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
     * @var array
     */
    protected $comments = [];

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
    public function setPrivate(bool $private): ClassBase
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
    public function setProtected(bool $protected): ClassBase
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
    public function setPublic(bool $public): ClassBase
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

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     *
     * @return ClassBase
     */
    public function setComments(array $comments): ClassBase
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @param string $comment
     *
     * @return ClassBase
     */
    public function addComment(string $comment): ClassBase
    {
        $this->comments[] = $comment;
        return $this;
    }

    public function valueType($value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                $value = 'bool';
                break;
            case 'integer':
                $value = 'int';
                break;
            case 'double':
                $value = 'float';
                break;
            case 'NULL':
                $value = 'null';
                break;
            default:
                break;
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getValueType($value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                $value = $value ? 'true' : 'false';
                break;
            case 'integer':
            case 'double':
                $value = (string)$value;
                break;
            case 'string':
                $value = "'" . $value . "'";
                break;
            case 'resource':
                $value = '{resource}';
                break;
            case 'NULL':
                $value = 'null';
                break;
            case 'unknown type':
                $value = '{unknown}';
                break;
            default:
                break;
        }
        return $value;
    }
}
