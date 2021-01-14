<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Action\Controller\BaseActionControllerBuild;
use App\Component\Generate\Build\Action\Controller\ValidateParse\BaseValidateParse;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;

class ControllerBuild extends BaseBuild
{
    /**
     * @var array
     */
    private $service;

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @return array
     */
    public function getService(): array
    {
        return $this->service;
    }

    /**
     * @param array $service
     *
     * @return ControllerBuild
     */
    public function setService(array $service): ControllerBuild
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     *
     * @return ControllerBuild
     */
    public function setServiceName(string $serviceName): ControllerBuild
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    protected function getActionService(string $name, array $form, string $description = ''): array
    {
        $config = $this->getConfig()->getAction()->getController();
        $classname = null;
        if (!empty($config->getFirstNamespace())) {
            $classname = $config->getFirstNamespace() . '\\' . StringHelper::ucfirst($name) . $config->getSuffix();
            if (!class_exists($classname)) {
                $classname = null;
            }
        }
        if ($classname === null) {
            $classname = $config->getNamespace() . '\\' . StringHelper::ucfirst($name) . $config->getSuffix();
        }
        if (!class_exists($classname)) {
            $classname = $config->getNamespace() . '\\Default' . $config->getSuffix();
        }

        // path
        $paths = [
            $this->getConfig()->getController()->getPrefix(),
        ];
        $directory = str_replace($this->getConfig()->getDefault()->getController()->getPath(), '', $this->getGenerateCodeEntity()->getController());
        $controllerPath = StringHelper::dirname($directory);
        if ($controllerPath !== '/') {
            $paths[] = $controllerPath;
        }
        $paths[] = StringHelper::basename($directory, 'Controller');
        $paths[] = $name;

        $validateParse = $this->getConfig()->getController()->getAnnotationValidateParse();
        /**
         * @var BaseValidateParse $parse
         */
        $parse = new $validateParse;
        $parse->setParams($form)->setPath(implode('/', array_map(function ($path) {
            return StringHelper::strtolower($path);
        }, $paths)))->setDescription($this->getGenerateCodeEntity()->getName() . $description);

        /**
         * @var BaseActionControllerBuild $model
         */
        $model = new $classname;
        $model->setName($name)->setValidateParse($parse)->setServiceName($this->getServiceName());
        return [$model->getMethod(), $model->getUses(), $parse->getPath()];
    }

    public function build(): array
    {
        $this->setServiceName(lcfirst($this->getService()['classname']));
        $properties = call_user_func($this->getConfig()->getController()->getProperties(), $this);
        $uses = $this->getConfig()->getController()->getUses();
        $uses[] = $this->getService()['class'];
        $routs = $methods = $actions = [];

        // todo 如果有 查询 则有 list
        if (1 || !empty($this->getGenerateCodeEntity()->getSearch())) {
//            [$method, $use] = $this->getActionService('list', $this->getGenerateCodeEntity()->getSearch(), '列表');
            [$method, $use, $rout] = $this->getActionService('list', [], '列表');
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
            $routs[] = $rout;
        }

        foreach ($this->getGenerateCodeEntity()->getActions() as $action) {
            if (in_array($action->getPath(), $actions)) {
                continue;
            }
//            [$method, $use] = $this->getActionService($action->getPath(), $action->getForm()->getItem(), $action->getName());
            [$method, $use, $rout] = $this->getActionService($action->getPath(), [], $action->getName());
            $methods[] = $method;
            $uses = ArrayHelper::merge($uses, $use);
            $actions[] = $action->getPath();
            $routs[] = $rout;
        }

        $class = $this->getNamespace($this->getGenerateCodeEntity()->getController());
        $classname = StringHelper::basename($class);
        $namespace = StringHelper::dirname($class);
        $comment = [
            "class {$classname}",
            "@package {$namespace}",
        ];
        $comment = ArrayHelper::merge($comment, call_user_func($this->getConfig()->getController()->getComment(), $this));
        $params = [
            'namespace'   => $namespace,
            'classname'   => $classname,
            'uses'        => $uses,
            'comments'    => $comment,
            'inheritance' => $this->getConfig()->getController()->getInheritance(),
            'properties'  => $properties,
            'methods'     => $methods,
        ];
        $this->output($params, StringHelper::dirname($this->getGenerateCodeEntity()->getController()));
        return $routs;
    }
}
