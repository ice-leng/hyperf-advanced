<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildActionConfig extends BaseObject
{
    /**
     * 服务
     * @var BuildActionClassConfig
     */
    private $service;

    /**
     * 控制器
     * @var BuildActionClassConfig
     */
    private $controller;

    /**
     * @return BuildActionClassConfig
     */
    public function getService(): BuildActionClassConfig
    {
        return $this->service;
    }

    /**
     * @param BuildActionClassConfig $service
     *
     * @return BuildActionConfig
     */
    public function setService(BuildActionClassConfig $service): BuildActionConfig
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return BuildActionClassConfig
     */
    public function getController(): BuildActionClassConfig
    {
        return $this->controller;
    }

    /**
     * @param BuildActionClassConfig $controller
     *
     * @return BuildActionConfig
     */
    public function setController(BuildActionClassConfig $controller): BuildActionConfig
    {
        $this->controller = $controller;
        return $this;
    }
}
