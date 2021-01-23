<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Config\BuildConfig;
use App\Component\Generate\ClassFile\ClassConfig;
use App\Component\Generate\Generate;
use App\Entity\GenerateCodeEntity;
use Exception;
use Lengbin\Common\Component\BaseObject;
use Lengbin\Helper\YiiSoft\StringHelper;

abstract class BaseBuild extends BaseObject
{
    /**
     * @var string
     */
    protected $root;

    /**
     * @var BuildConfig
     */
    protected $config;

    /**
     * @var GenerateCodeEntity
     */
    protected $generateCodeEntity;

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
     * @return BaseBuild
     */
    public function setConfig(BuildConfig $config): BaseBuild
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
     * @return BaseBuild
     */
    public function setGenerateCodeEntity(GenerateCodeEntity $generateCodeEntity): BaseBuild
    {
        $this->generateCodeEntity = $generateCodeEntity;
        return $this;
    }

    /**
     * @param ClassConfig $config
     * @param string      $path
     *
     * @return string
     * @throws Exception
     */
    protected function output(ClassConfig $config, string $path): string
    {
        $generate = new Generate();
        $generate->setPath($this->getRoot() . '/' . $path);
        $generate->setConfig($config);
        return $generate->output('php');
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getNamespace(string $name): string
    {
        return implode('\\', array_map(function ($str) {
            return StringHelper::ucfirst($str);
        }, StringHelper::explode($name, '/')));
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
     * @return BaseBuild
     */
    public function setRoot(string $root): BaseBuild
    {
        $this->root = $root;
        return $this;
    }

    abstract public function build();
}
