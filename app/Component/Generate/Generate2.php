<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;
use Lengbin\Helper\Util\FileHelper;

class Generate2 extends BaseObject
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var TemplateInterface
     */
    private $template;

    /**
     * 输出路径
     * @var string
     */
    private $path;

    /**
     * 模版
     * @var string
     */
    private $tpl = 'class.tpl';

    /**
     * @return string
     */
    public function getTpl(): string
    {
        return $this->tpl;
    }

    /**
     * @param string $tpl
     *
     * @return Generate2
     */
    public function setTpl(string $tpl): Generate2
    {
        $this->tpl = $tpl;
        return $this;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     *
     * @return Generate2
     */
    public function setConfig(Config $config): Generate2
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    /**
     * @param TemplateInterface $template
     *
     * @return Generate2
     */
    public function setTemplate(TemplateInterface $template): Generate2
    {
        $this->template = $template;
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
     * 获得 模版内容
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getTemplate()->render($this->getTpl(), $this->getConfig()->toArray());
    }

    /**
     * @param string $path
     *
     * @return Generate2
     */
    public function setPath(string $path): Generate2
    {
        $this->path = $path;
        return $this;
    }

    /**
     * 获得 输出文件 path
     *
     * @param string $suffix
     *
     * @return string
     */
    public function getFilePath(string $suffix = 'php'): string
    {
        $ext = FileHelper::getExtension($suffix);
        $classname = $this->getConfig()->getClassname();
        return implode(DIRECTORY_SEPARATOR, [
            $this->getPath(),
            $classname,
            '.',
            $ext,
        ]);
    }

    /**
     * 输出
     *
     * @param string $suffix
     *
     * @return bool
     */
    public function output(string $suffix = 'php'): bool
    {
        return FileHelper::putFile($this->getFilePath($suffix), $this->getContent());
    }
}
