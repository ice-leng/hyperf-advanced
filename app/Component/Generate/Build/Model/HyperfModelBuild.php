<?php

namespace App\Component\Generate\Build\Model;

use App\Component\Generate\Build\BaseBuild;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Component\Generate\Model\GenerateModel;

class HyperfModelBuild extends BaseBuild
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $pool;

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
     * @return HyperfModelBuild
     */
    public function setPath(string $path): HyperfModelBuild
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPool(): string
    {
        return $this->pool;
    }

    /**
     * @param string $pool
     *
     * @return HyperfModelBuild
     */
    public function setPool(string $pool): HyperfModelBuild
    {
        $this->pool = $pool;
        return $this;
    }

    public function build(): array
    {
        $class = $this->getNamespace($this->getPath());
        $table = StringHelper::basename($class);
        $model = new GenerateModel();
        $data = $model->create($table, $this->getPool(), StringHelper::dirname($this->getPath()));
        return [
            'classname'  => $table,
            'class'      => $class,
            'primaryKey' => $data[$table],
        ];
    }
}
