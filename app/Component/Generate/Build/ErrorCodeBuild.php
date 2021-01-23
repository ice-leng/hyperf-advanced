<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Collection\BaseBuildCollection;
use App\Component\Generate\Build\Collection\ErrorCodeBuildCollection;
use App\Component\Generate\Build\Collection\ModelBuildCollection;
use App\Component\Generate\ClassFile\ClassConfig;
use Exception;
use Lengbin\Helper\Util\FileHelper;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;

class ErrorCodeBuild extends BaseBuild
{
    /**
     * 允许 类型
     *
     * @var array
     */
    protected $allow = [
        'create',
        'update',
        'remove',
        'import',
        'export',
    ];

    /**
     * @var ModelBuildCollection
     */
    private $model;

    /**
     * @return ModelBuildCollection
     */
    public function getModel(): ModelBuildCollection
    {
        return $this->model;
    }

    /**
     * @param ModelBuildCollection $model
     *
     * @return ErrorCodeBuild
     */
    public function setModel(ModelBuildCollection $model): ErrorCodeBuild
    {
        $this->model = $model;
        return $this;
    }

    /**
     * 文件名称
     * @return string
     */
    protected function getName(): string
    {
        return $this->getModel()->getClassname() . 'Error';
    }

    /**
     * 获得  错误字段 值的 前缀
     *
     * @param string $path
     *
     * @return array
     */
    protected function getPrefix(string $path): array
    {
        $defaultPath = $this->getConfig()->getDefault()->getErrorCode()->getPath();
        $directory = str_replace($defaultPath, '', $path);
        $errorPrefix = StringHelper::explode($directory, '/', true, true);
        // default  prefix
        $prefix = ArrayHelper::get($this->getConfig()->getErrorCode()->getPrefix(), 'default', 'B-001');
        if (!empty($errorPrefix[0])) {
            $appErrorPrefix = ArrayHelper::get($this->getConfig()->getErrorCode()->getPrefix(), StringHelper::strtolower($errorPrefix[0]));
            if (!empty($appErrorPrefix)) {
                $prefix = $appErrorPrefix;
                $defaultPath .= "/{$errorPrefix[0]}";
            }
        }
        $scan = FileHelper::scan($this->getRoot() . '/' . $defaultPath);
        $number = iterator_count($scan) + 1;
        $prefix .= '-' . str_pad($number, 3, "0", STR_PAD_LEFT);
        $errorPrefix[] = $this->getModel()->getClassname();
        array_unshift($errorPrefix, 'errors');
        return [
            'value' => $prefix,
            'name'  => implode("_", $errorPrefix),
        ];
    }

    /***
     * 获得 常量
     *
     * @param string $path
     *
     * @return array
     */
    protected function getConstant(string $path): array
    {
        // prefix
        $prefix = $this->getPrefix($path);
        $constants = [];
        $num = 1;
        $isChange = false;
        foreach ($this->getGenerateCodeEntity()->getActions() as $action) {
            if (StringHelper::matchWildcard('change*', $action->getPath())) {
                $isChange = true;
            }
            if (!in_array($action->getPath(), $this->allow) || !empty($constants[$action->getPath()])) {
                continue;
            }
            $constantName = $action->getPath() . '_fail';
            $constantMessage = $action->getName() . '失败';
            $constants[$action->getPath()] = [
                'name'     => StringHelper::strtoupper($prefix['name'] . "_" . $constantName),
                'default'  => $prefix['value'] . '-' . str_pad($num, 3, "0", STR_PAD_LEFT),
                'comments' => [
                    '@Message("' . $this->getGenerateCodeEntity()->getName() . $constantMessage . '")',
                ],
            ];
            $num++;
        }

        $constants['notFound'] = [
            'name'     => StringHelper::strtoupper($prefix['name'] . "_not_found"),
            'default'  => $prefix['value'] . '-' . str_pad($num, 3, "0", STR_PAD_LEFT),
            'comments' => [
                '@Message("' . $this->getGenerateCodeEntity()->getName() . '不存在")',
            ],
        ];

        // 修改的 归于 更新
        if ($isChange && empty($constants['update'])) {
            $num++;
            $constants['update'] = [
                'name'     => StringHelper::strtoupper($prefix['name'] . "_update_fail"),
                'default'  => $prefix['value'] . '-' . str_pad($num, 3, "0", STR_PAD_LEFT),
                'comments' => [
                    '@Message("' . $this->getGenerateCodeEntity()->getName() . '更新失败")',
                ],
            ];
        }

        return $constants;
    }

    /**
     * @return ErrorCodeBuildCollection
     * @throws Exception
     */
    public function build(): ErrorCodeBuildCollection
    {
        $defaultConfig = $this->getConfig()->getDefault();
        // 错误码 目录结构 基于 服务目录结构
        $errorCodePath = str_replace($defaultConfig->getService()->getPath(), $defaultConfig->getErrorCode()->getPath(),
            $this->getGenerateCodeEntity()->getService());
        $path = StringHelper::dirname($errorCodePath);
        $constants = $this->getConstant($path);

        $class = $this->getNamespace($path . '/' . $this->getName());
        $namespace = StringHelper::dirname($class);

        $config = [
            'namespace'   => $namespace,
            'classname'   => $this->getName(),
            'uses'        => [
                $this->getConfig()->getErrorCode()->getUse(),
            ],
            'comments'    => [
                "class {$this->getName()}",
                "@package {$namespace}",
            ],
            'inheritance' => $this->getConfig()->getErrorCode()->getInheritance(),
            'constants'   => $constants,
        ];
        $file = $this->output(new ClassConfig($config), $path);
        return new ErrorCodeBuildCollection([
            'classname' => $this->getName(),
            'class'     => $class,
            'file'      => $file,
            'constants' => ArrayHelper::getColumn($constants, 'name'),
        ]);
    }
}
