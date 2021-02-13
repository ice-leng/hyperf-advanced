<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;
use App\Component\Generate\Build\Collection\BaseBuildCollection;
use App\Component\Generate\Build\Collection\ErrorCodeBuildCollection;
use App\Component\Generate\Build\Collection\ModelBuildCollection;
use App\Component\Generate\ClassFile\ClassConfig;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;

class ServiceBuild extends BaseBuild
{
    /**
     * @var ErrorCodeBuildCollection
     */
    private $errorCode;

    /**
     * @var ModelBuildCollection
     */
    private $model;

    /**
     * @return ErrorCodeBuildCollection
     */
    public function getErrorCode(): ErrorCodeBuildCollection
    {
        return $this->errorCode;
    }

    /**
     * @param ErrorCodeBuildCollection $errorCode
     *
     * @return ServiceBuild
     */
    public function setErrorCode(ErrorCodeBuildCollection $errorCode): ServiceBuild
    {
        $this->errorCode = $errorCode;
        return $this;
    }

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
     * @return ServiceBuild
     */
    public function setModel(ModelBuildCollection $model): ServiceBuild
    {
        $this->model = $model;
        return $this;
    }

    protected function getActionService(string $name, string $description = ''): array
    {
        $config = $this->getConfig()->getAction()->getService();
        $actionName = $name;
        if (StringHelper::matchWildcard('change*', $name)) {
            $name = 'change';
        }

        $classname = '';
        if (!empty($config->getFirstNamespace())) {
            $classname = $config->getFirstNamespace() . '\\' . StringHelper::ucfirst($name) . $config->getSuffix();
            if (!class_exists($classname)) {
                $classname = '';
            }
        }

        if ($classname === '') {
            $classname = $config->getNamespace() . '\\' . StringHelper::ucfirst($name) . $config->getSuffix();
        }

        if (!class_exists($classname)) {
            $classname = $config->getNamespace() . '\\Default' . $config->getSuffix();
        }
        /**
         * @var BaseActionServiceBuild $model
         */
        $model = new $classname;
        $model->setModel($this->getModel())
            ->setError($this->getErrorCode())
            ->setName($actionName)
            ->setExceptionName($this->getConfig()->getException()->getInheritance())
            ->setDescription($description);
        return [$model->getMethod(), $model->getUses()];
    }

    /**
     * @return BaseBuildCollection
     * @throws \Exception
     */
    public function build(): BaseBuildCollection
    {
        $uses = [
            $this->getModel()->getClass(),
            $this->getErrorCode()->getClass(),
            $this->getConfig()->getException()->getUse(),
            $this->getConfig()->getService()->getUse(),
        ];

        $methods = $actions = [];
        // todo 如果有 查询 则有 list
        if (1 || !empty($this->getGenerateCodeEntity()->getSearch())) {
            [$method, $use] = $this->getActionService('list', '列表');
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
            $actions[] = 'list';
        }

        foreach ($this->getGenerateCodeEntity()->getActions() as $action) {
            if (in_array($action->getPath(), $actions)) {
                continue;
            }
            [$method, $use] = $this->getActionService($action->getPath(), $action->getName());
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
            $actions[] = $action->getPath();
        }

        // findOne
        if (in_array('update', $actions) || in_array('detail', $actions)) {
            [$method, $use] = $this->getActionService('findOne', 'find one model');
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
        }

        // formatModel
        if (in_array('list', $actions) || in_array('detail', $actions)) {
            [$method, $use] = $this->getActionService('formatModel', '格式化');
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
        }

        $class = $this->getNamespace($this->getGenerateCodeEntity()->getService());
        $classname = StringHelper::basename($class);
        $namespace = StringHelper::dirname($class);
        $config = [
            'namespace'   => $namespace,
            'classname'   => $classname,
            'uses'        => $uses,
            'comments'    => [
                "class {$classname}",
                "@package {$namespace}",
            ],
            'inheritance' => $this->getConfig()->getService()->getInheritance(),
            'methods'     => $methods,
        ];
        $file = $this->output(new ClassConfig($config), StringHelper::dirname($this->getGenerateCodeEntity()->getService()));
        return new BaseBuildCollection([
            'classname' => $classname,
            'class'     => $class,
            'file'      => $file,
        ]);
    }
}
