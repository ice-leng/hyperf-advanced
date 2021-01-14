<?php

namespace App\Component\Generate\Build\Action;

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
     * @var string
     */
    protected $name;

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
}
