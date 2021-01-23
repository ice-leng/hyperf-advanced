<?php

namespace App\Component\Generate\Build\Collection;

class ModelBuildCollection extends BaseBuildCollection
{
    /**
     * @var string
     */
    private $primaryKey;

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     *
     * @return ModelBuildCollection
     */
    public function setPrimaryKey(string $primaryKey): ModelBuildCollection
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }
}
