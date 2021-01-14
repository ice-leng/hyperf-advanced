<?php

namespace App\Component\Generate\Build\Action\Service;

use App\Component\Generate\Build\Action\BaseActionBuild;
use App\Entity\GenerateCodeEntity;

abstract class BaseActionServiceBuild extends BaseActionBuild
{
    public function getUses(): array
    {
        return [];
    }

    public function getParams(): array
    {
        return [
            ['name' => 'params', 'type' => 'array', 'comment' => '参数'],
        ];
    }

    public function getComment(): array
    {
        return [
            $this->getDescription()
        ];
    }

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var array
     */
    protected $model;

    /**
     * @var string
     */
    protected $exceptionName;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     *
     * @return BaseActionServiceBuild
     */
    public function setErrors(array $errors): BaseActionServiceBuild
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return array
     */
    public function getModel(): array
    {
        return $this->model;
    }

    /**
     * @param array $model
     *
     * @return BaseActionServiceBuild
     */
    public function setModel(array $model): BaseActionServiceBuild
    {
        $this->model = $model;
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
     * @return BaseActionServiceBuild
     */
    public function setExceptionName(string $exceptionName): BaseActionServiceBuild
    {
        $this->exceptionName = $exceptionName;
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
     * @return BaseActionBuild
     */
    public function setDescription(string $description): BaseActionBuild
    {
        $this->description = $description;
        return $this;
    }
}
