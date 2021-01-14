<?php

namespace App\Component\Generate\Build\Config;

use App\Component\AntDesign\Link\Link;
use Lengbin\Common\Component\BaseObject;

class BuildDefaultConfig extends BaseObject
{
    /**
     * 控制 默认 配置
     * @var BuildDefaultBaseConfig
     */
    private $controller;

    /**
     * 服务 ，默认配置
     * @var BuildDefaultBaseConfig
     */
    private $service;

    /**
     * 错误字典 默认配置
     * @var BuildDefaultBaseConfig
     */
    private $errorCode;

    /**
     * 操作  默认配置
     * @var Link[]
     */
    private $action;

    /**
     * @return BuildDefaultBaseConfig
     */
    public function getController(): BuildDefaultBaseConfig
    {
        return $this->controller;
    }

    /**
     * @param BuildDefaultBaseConfig $controller
     *
     * @return BuildDefaultConfig
     */
    public function setController(BuildDefaultBaseConfig $controller): BuildDefaultConfig
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return BuildDefaultBaseConfig
     */
    public function getService(): BuildDefaultBaseConfig
    {
        return $this->service;
    }

    /**
     * @param BuildDefaultBaseConfig $service
     *
     * @return BuildDefaultConfig
     */
    public function setService(BuildDefaultBaseConfig $service): BuildDefaultConfig
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return BuildDefaultBaseConfig
     */
    public function getErrorCode(): BuildDefaultBaseConfig
    {
        return $this->errorCode;
    }

    /**
     * @param BuildDefaultBaseConfig $errorCode
     *
     * @return BuildDefaultConfig
     */
    public function setErrorCode(BuildDefaultBaseConfig $errorCode): BuildDefaultConfig
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return Link[]
     */
    public function getAction(): array
    {
        return $this->action;
    }

    /**
     * @param Link[] $action
     *
     * @return BuildDefaultConfig
     */
    public function setAction(array $action): BuildDefaultConfig
    {
        $this->action = $action;
        return $this;
    }
}
