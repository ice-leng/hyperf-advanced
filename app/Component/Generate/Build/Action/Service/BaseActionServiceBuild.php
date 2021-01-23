<?php

namespace App\Component\Generate\Build\Action\Service;

use App\Component\Generate\Build\Action\BaseActionBuild;
use App\Component\Generate\Build\Collection\ModelBuildCollection;

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
            $this->getDescription(),
        ];
    }

    /**
     * @var ModelBuildCollection
     */
    protected $model;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return ModelBuildCollection
     */
    public function getModel(): ModelBuildCollection
    {
        return $this->model;
    }

    /**
     * @param ModelBuildCollection $model
     *
     * @return BaseActionServiceBuild
     */
    public function setModel(ModelBuildCollection $model): BaseActionServiceBuild
    {
        $this->model = $model;
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
     * @return BaseActionServiceBuild
     */
    public function setDescription(string $description): BaseActionServiceBuild
    {
        $this->description = $description;
        return $this;
    }
}
