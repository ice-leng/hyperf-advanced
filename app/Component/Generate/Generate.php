<?php

namespace App\Component\Generate;

use Exception;
use Lengbin\Helper\Util\FileHelper;

class Generate
{
    /**
     * 输出路径
     * @var string
     */
    private $path;

    /**
     * @var AbstractConfig
     */
    private $config;

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
     * @return AbstractConfig
     */
    public function getConfig(): AbstractConfig
    {
        return $this->config;
    }

    /**
     * @param AbstractConfig $config
     *
     * @return Generate
     */
    public function setConfig(AbstractConfig $config): Generate
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param string $suffix
     *
     * @return string
     * @throws Exception
     */
    public function output(string $suffix): string
    {
        $file = implode(DIRECTORY_SEPARATOR, [
                $this->getPath(),
                $this->getConfig()->getFileName(),
            ]) . '.' . FileHelper::getExtension($suffix);
        $status = FileHelper::putFile($file, $this->getConfig()->getContent());
        if (!$status) {
            throw new Exception("{$file} generate fail");
        }
        return $file;
    }
}
