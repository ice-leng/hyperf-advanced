<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;
use Lengbin\Helper\Util\FileHelper;
use SmartyException;

class Generate extends BaseObject
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Template
     */
    private $template;

    /**
     * 输出路径
     * @var string
     */
    private $path;

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
     * @return Generate
     */
    public function setConfig(Config $config): Generate
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

    /**
     * @param Template $template
     *
     * @return Generate
     */
    public function setTemplate(Template $template): Generate
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
     * @param string $path
     *
     * @return Generate
     */
    public function setPath(string $path): Generate
    {
        $this->path = $path;
        return $this;
    }

    /**
     *
     * @param string $suffix
     *
     * @return string
     */
    public function getFilePath(string $suffix = 'php'): string
    {
        $classname = $this->getConfig()->getClassname();
        return implode(DIRECTORY_SEPARATOR, [
            $this->getPath(),
            $classname,
            '.',
            $suffix,
        ]);
    }

    /**
     * @param string $view
     *
     * @return string
     * @throws SmartyException
     */
    public function getContent($view = 'Class.tpl'): string
    {
        return $this->getTemplate()->render($view, $this->getConfig()->toArray());
    }

    /**
     * @param string $suffix
     * @param string $view
     *
     * @return bool
     * @throws SmartyException
     */
    public function output(string $suffix = 'php', $view = 'Class.tpl'): bool
    {
        return FileHelper::putFile($this->getFilePath($suffix), $this->getContent($view));
    }
}
