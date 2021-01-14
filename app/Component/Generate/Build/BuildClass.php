<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Config\BuildConfig;
use App\Entity\GenerateCodeEntity;

class BuildClass
{
    /**
     * 根路径
     * @var string
     */
    private $root;

    /**
     * @var BaseBuild
     */
    private $model;

    /**
     * @var ServiceBuild
     */
    private $service;

    /**
     * @var ErrorCodeBuild
     */
    private $errorCode;

    /**
     * @var ControllerBuild
     */
    private $controller;

    /**
     * @var BuildConfig
     */
    private $config;

    /**
     * @var GenerateCodeEntity
     */
    private $generateCodeEntity;

    /**
     * @param $build
     *
     * @return mixed
     */
    protected function init($build)
    {
        return $build->setRoot($this->getRoot())->setConfig($this->getConfig())->setGenerateCodeEntity($this->getGenerateCodeEntity());
    }

    /**
     * @return BaseBuild
     */
    public function getModel(): BaseBuild
    {
        return $this->model;
    }

    /**
     * @param BaseBuild $model
     *
     * @return BuildClass
     */
    public function setModel(BaseBuild $model): BuildClass
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return ServiceBuild
     */
    public function getService(): ServiceBuild
    {
        return $this->init($this->service);
    }

    /**
     * @param ServiceBuild $service
     *
     * @return BuildClass
     */
    public function setService(ServiceBuild $service): BuildClass
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return ErrorCodeBuild
     */
    public function getErrorCode(): ErrorCodeBuild
    {
        return $this->init($this->errorCode);
    }

    /**
     * @param ErrorCodeBuild $errorCode
     *
     * @return BuildClass
     */
    public function setErrorCode(ErrorCodeBuild $errorCode): BuildClass
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return ControllerBuild
     */
    public function getController(): ControllerBuild
    {
        return $this->init($this->controller);
    }

    /**
     * @param ControllerBuild $controller
     *
     * @return BuildClass
     */
    public function setController(ControllerBuild $controller): BuildClass
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return BuildConfig
     */
    public function getConfig(): BuildConfig
    {
        return $this->config;
    }

    /**
     * @param BuildConfig $config
     *
     * @return BuildClass
     */
    public function setConfig(BuildConfig $config): BuildClass
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return GenerateCodeEntity
     */
    public function getGenerateCodeEntity(): GenerateCodeEntity
    {
        return $this->generateCodeEntity;
    }

    /**
     * @param GenerateCodeEntity $generateCodeEntity
     *
     * @return BuildClass
     */
    public function setGenerateCodeEntity(GenerateCodeEntity $generateCodeEntity): BuildClass
    {
        $this->generateCodeEntity = $generateCodeEntity;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * @param string $root
     *
     * @return BuildClass
     */
    public function setRoot(string $root): BuildClass
    {
        $this->root = $root;
        return $this;
    }

    public function run(): array
    {
        $model = $this->getModel()->build();
        $errorCode = $this->getErrorCode()->setModelName($model['classname'])->build();
        $service = $this->getService()->setModel($model)->setErrorCode($errorCode)->build();
        $controller = $this->getController()->setService($service)->build();
        return [
            'file' => array_map(function ($file) {
                return $this->getRoot() . '/' . $file . '.php';
            }, [
                'model'      => $this->generateCodeEntity->getModel(),
                'service'    => $this->generateCodeEntity->getService(),
                'controller' => $this->getGenerateCodeEntity()->getController(),
                'errorCode'  => $errorCode['path'],
            ]),
            'path' => $controller,
        ];
    }
}
