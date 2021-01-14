<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Action\Service\BaseActionServiceBuild;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;

class ServiceBuild extends BaseBuild
{
    /**
     * @var array
     */
    private $errorCode;

    /**
     * @var array
     */
    private $model;

    /**
     * @return array
     */
    public function getErrorCode(): array
    {
        return $this->errorCode;
    }

    /**
     * @param array $errorCode
     *
     * @return ServiceBuild
     */
    public function setErrorCode(array $errorCode): ServiceBuild
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getModel(): array
    {
        return $this->model;
    }

    /**
     * @param array $model
     *
     * @return ServiceBuild
     */
    public function setModel(array $model): ServiceBuild
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
            ->setErrors($this->getErrorCode())
            ->setName($actionName)
            ->setDescription($description)
            ->setExceptionName($this->getConfig()->getException()->getInheritance());
        return [$model->getMethod(), $model->getUses()];
    }

    public function build(): array
    {
        $uses = [
            $this->getModel()['class'],
            $this->getErrorCode()['class'],
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
        $params = [
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
        $this->output($params, StringHelper::dirname($this->getGenerateCodeEntity()->getService()));
        return [
            'classname' => $classname,
            'class'     => $class,
        ];
    }
}
