<?php

namespace App\Component\Generate\Build\Action;

use App\Component\Generate\Build\Collection\ErrorCodeBuildCollection;

abstract class BaseActionBuild
{
    /**
     * use
     * @return array
     */
    abstract public function getUses(): array;

    /**
     * return content
     * @return array
     */
    abstract public function getContent(): array;

    /**
     * @return array
     */
    abstract public function getParams(): array;

    /**
     * @return string
     */
    abstract public function getReturn(): string;

    /**
     * @return array
     */
    abstract public function getComment(): array;

    /**
     * @return array
     */
    public function getMethod(): array
    {
        $content = $this->getSpaces(2) . implode("\n" . $this->getSpaces(2), $this->getContent());
        return [
            "name"     => $this->getName(),
            'params'   => $this->getParams(),
            'return'   => $this->getReturn(),
            'content'  => $content,
            'comments' => $this->getComment(),
        ];
    }

    /**
     * @param int $level
     *
     * @return string
     */
    public function getSpaces(int $level = 1): string
    {
        return str_repeat(' ', $level * 4);
    }

    /**
     * @param string $name
     * @param int    $level
     *
     * @return string
     */
    public function throwExceptionForError(string $name, int $level = 1): string
    {
        return $this->getSpaces($level) . "throw new {$this->getExceptionName()}({$this->getError()->getClassname()}::{$this->getError()->getConstant($name)});";
    }

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $exceptionName;

    /**
     * @var ErrorCodeBuildCollection
     */
    protected $error;

    /**
     * @return ErrorCodeBuildCollection
     */
    public function getError(): ErrorCodeBuildCollection
    {
        return $this->error;
    }

    /**
     * @param ErrorCodeBuildCollection $error
     *
     * @return BaseActionBuild
     */
    public function setError(ErrorCodeBuildCollection $error): BaseActionBuild
    {
        $this->error = $error;
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
     * @return BaseActionBuild
     */
    public function setName(string $name): BaseActionBuild
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getExceptionName(): string
    {
        return $this->exceptionName;
    }

    /**
     * @param string $exceptionName
     *
     * @return BaseActionBuild
     */
    public function setExceptionName(string $exceptionName): BaseActionBuild
    {
        $this->exceptionName = $exceptionName;
        return $this;
    }
}
