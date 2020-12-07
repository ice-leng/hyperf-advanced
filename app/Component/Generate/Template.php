<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;
use Smarty;
use SmartyException;

class Template extends BaseObject
{

    /**
     * @var Smarty
     */
    protected $smarty;

    /**
     * @var ?string
     */
    private $view;

    /**
     * @var ?string
     */
    private $cacheDir;

    /**
     * @var ?string
     */
    private $compileDir;

    /**
     * @var string
     */
    private $leftDelimiter = '{{';

    /**
     * @var string
     */
    private $rightDelimiter = '}}';

    /**
     * @return string|null
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * @param string|null $view
     *
     * @return Template
     */
    public function setView(?string $view): Template
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCacheDir(): ?string
    {
        return $this->cacheDir;
    }

    /**
     * @param string|null $cacheDir
     *
     * @return Template
     */
    public function setCacheDir(?string $cacheDir): Template
    {
        $this->cacheDir = $cacheDir;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompileDir(): ?string
    {
        return $this->compileDir;
    }

    /**
     * @param string|null $compileDir
     *
     * @return Template
     */
    public function setCompileDir(?string $compileDir): Template
    {
        $this->compileDir = $compileDir;
        return $this;
    }

    /**
     * @return string
     */
    public function getLeftDelimiter(): string
    {
        return $this->leftDelimiter;
    }

    /**
     * @param string $leftDelimiter
     *
     * @return Template
     */
    public function setLeftDelimiter(string $leftDelimiter): Template
    {
        $this->leftDelimiter = $leftDelimiter;
        return $this;
    }

    /**
     * @return string
     */
    public function getRightDelimiter(): string
    {
        return $this->rightDelimiter;
    }

    /**
     * @param string $rightDelimiter
     *
     * @return Template
     */
    public function setRightDelimiter(string $rightDelimiter): Template
    {
        $this->rightDelimiter = $rightDelimiter;
        return $this;
    }

    /**
     * init
     */
    public function init()
    {
        if ($this->getView() === null) {
            $this->setView(__DIR__ . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
        }

        $temp = sys_get_temp_dir();
        if ($this->getCacheDir() === null) {
            $this->setCacheDir("{$temp}/smarty/cache/");
        }

        if ($this->getCompileDir() === null) {
            $this->setCompileDir("{$temp}/smarty/compile/");
        }

        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir($this->getView());
        $this->smarty->setCacheDir($this->getCacheDir());
        $this->smarty->setCompileDir($this->getCompileDir());
        $this->smarty->setLeftDelimiter($this->getLeftDelimiter());
        $this->smarty->setRightDelimiter($this->getRightDelimiter());
    }

    /**
     * @param string $template
     * @param array  $data
     *
     * @return string|null
     * @throws SmartyException
     */
    public function render(string $template, array $data = []): ?string
    {
        foreach ($data as $key => $item) {
            $this->smarty->assign($key, $item);
        }

        return $this->smarty->fetch($template);
    }
}
