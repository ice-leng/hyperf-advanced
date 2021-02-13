<?php

namespace App\Component\Generate\Build\Config;

use Lengbin\Common\Component\BaseObject;

class BuildConfig extends BaseObject
{
    /**
     * 配置  默认
     * @var BuildDefaultConfig
     */
    private $default;

    /**
     * 配置 控制器
     * @var BuildControllerConfig
     */
    private $controller;

    /**
     * 操作
     * @var BuildActionConfig
     */
    private $action;

    /**
     * 错误字典
     * @var BuildErrorCodeConfig
     */
    private $errorCode;

    /**
     * 服务
     * @var BuildServiceConfig
     */
    private $service;

    /**
     * @var BuildExceptionConfig
     */
    private $exception;

    /**
     * @return BuildDefaultConfig
     */
    public function getDefault(): BuildDefaultConfig
    {
        return $this->default;
    }

    /**
     * @param BuildDefaultConfig $default
     *
     * @return BuildConfig
     */
    public function setDefault(BuildDefaultConfig $default): BuildConfig
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return BuildControllerConfig
     */
    public function getController(): BuildControllerConfig
    {
        return $this->controller;
    }

    /**
     * @param BuildControllerConfig $controller
     *
     * @return BuildConfig
     */
    public function setController(BuildControllerConfig $controller): BuildConfig
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return BuildActionConfig
     */
    public function getAction(): BuildActionConfig
    {
        return $this->action;
    }

    /**
     * @param BuildActionConfig $action
     *
     * @return BuildConfig
     */
    public function setAction(BuildActionConfig $action): BuildConfig
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return BuildErrorCodeConfig
     */
    public function getErrorCode(): BuildErrorCodeConfig
    {
        return $this->errorCode;
    }

    /**
     * @param BuildErrorCodeConfig $errorCode
     *
     * @return BuildConfig
     */
    public function setErrorCode(BuildErrorCodeConfig $errorCode): BuildConfig
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return BuildServiceConfig
     */
    public function getService(): BuildServiceConfig
    {
        return $this->service;
    }

    /**
     * @param BuildServiceConfig $service
     *
     * @return BuildConfig
     */
    public function setService(BuildServiceConfig $service): BuildConfig
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return BuildExceptionConfig
     */
    public function getException(): BuildExceptionConfig
    {
        return $this->exception;
    }

    /**
     * @param BuildExceptionConfig $exception
     *
     * @return BuildConfig
     */
    public function setException(BuildExceptionConfig $exception): BuildConfig
    {
        $this->exception = $exception;
        return $this;
    }
}
