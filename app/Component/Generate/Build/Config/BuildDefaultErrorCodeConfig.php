<?php

namespace App\Component\Generate\Build\Config;

class BuildDefaultErrorCodeConfig extends BuildDefaultBaseConfig
{
    /**
     * @var array
     */
    private $prefix;

    /**
     * @return array
     */
    public function getPrefix(): array
    {
        return $this->prefix;
    }

    /**
     * @param array $prefix
     *
     * @return BuildDefaultErrorCodeConfig
     */
    public function setPrefix(array $prefix): BuildDefaultErrorCodeConfig
    {
        $this->prefix = $prefix;
        return $this;
    }
}
