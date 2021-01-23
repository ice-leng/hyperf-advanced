<?php

namespace App\Component\Generate\Build;

use App\Component\Generate\Build\Action\Controller\BaseActionControllerBuild;
use App\Component\Generate\Build\Action\Controller\ValidateParse\BaseValidateParse;
use App\Component\Generate\Build\Collection\BaseBuildCollection;
use App\Component\Generate\Build\Collection\ControllerBuildCollection;
use App\Component\Generate\Build\Collection\ErrorCodeBuildCollection;
use App\Component\Generate\ClassFile\ClassConfig;
use Exception;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Helper\YiiSoft\StringHelper;

class ControllerBuild extends BaseBuild
{
    /**
     * @var BaseBuildCollection
     */
    private $service;

    /**
     * @var ErrorCodeBuildCollection
     */
    private $errorCode;

    /**
     * @return BaseBuildCollection
     */
    public function getService(): BaseBuildCollection
    {
        return $this->service;
    }

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
     * @return ControllerBuild
     */
    public function setErrorCode(ErrorCodeBuildCollection $errorCode): ControllerBuild
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @param BaseBuildCollection $service
     *
     * @return ControllerBuild
     */
    public function setService(BaseBuildCollection $service): ControllerBuild
    {
        $this->service = $service;
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
        $directory = str_replace($this->getConfig()->getDefault()->getController()->getPath(), '', $this->getGenerateCodeEntity()->getController());
        $controllerPath = StringHelper::dirname($directory);
        $paths = StringHelper::explode($controllerPath, '/', true, true);
        $prefix = $this->getConfig()->getController()->getPrefix();
        if (!StringHelper::isEmpty($prefix)) {
            array_unshift($paths, $prefix);
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
        $model->setName($name)
            ->setValidateParse($parse)
            ->setError($this->getErrorCode())
            ->setExceptionName($this->getConfig()->getException()->getInheritance())
            ->setServiceName(lcfirst($this->getService()->getClassname()));
        return [$model->getMethod(), $model->getUses(), $parse->getPath()];
    }

    /**
     * @return ControllerBuildCollection
     * @throws Exception
     */
    public function build(): ControllerBuildCollection
    {
        $properties = call_user_func($this->getConfig()->getController()->getProperties(), $this);
        $uses = $this->getConfig()->getController()->getUses();
        $uses[] = $this->getService()->getClass();
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
        $config = [
            'namespace'   => $namespace,
            'classname'   => $classname,
            'uses'        => $uses,
            'comments'    => $comment,
            'inheritance' => $this->getConfig()->getController()->getInheritance(),
            'properties'  => $properties,
            'methods'     => $methods,
        ];
        $file = $this->output(new ClassConfig($config), StringHelper::dirname($this->getGenerateCodeEntity()->getController()));
        return new ControllerBuildCollection([
            'classname' => $classname,
            'class'     => $class,
            'rout'      => $routs,
            'file'      => $file,
        ]);
    }
}
