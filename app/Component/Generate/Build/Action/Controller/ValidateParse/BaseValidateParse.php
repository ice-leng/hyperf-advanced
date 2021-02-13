<?php

namespace App\Component\Generate\Build\Action\Controller\ValidateParse;

use Lengbin\Common\Component\BaseObject;

abstract class BaseValidateParse extends BaseObject
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return BaseValidateParse
     */
    public function setParams(array $params): BaseValidateParse
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return BaseValidateParse
     */
    public function setDescription(string $description): BaseValidateParse
    {
        $this->description = $description;
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
     * @return BaseValidateParse
     */
    public function setPath(string $path): BaseValidateParse
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return array
     */
    abstract public function parse(): array;
}
