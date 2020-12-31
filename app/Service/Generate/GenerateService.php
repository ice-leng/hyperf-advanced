<?php

namespace App\Service\Generate;

use App\Component\AntDesign\Link;
use App\Entity\GenerateCodeEntity;
use Hyperf\Utils\Str;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Component\Generate\Model\GenerateModel;
use Lengbin\Hyperf\Common\Framework\BaseService;

class GenerateService extends BaseService
{
    protected function getPath(string $name)
    {
        return str_replace('\\', '/', $name);
    }

    protected function getNamespace(string $name): string
    {
        return implode('\\', array_map(function ($str) {
            return StringHelper::ucfirst($str);
        }, explode('\\', $this->getPath($name))));
    }

    protected function controllerPhpFile(string $path, array $actions): array
    {
        $namespace = $this->getNamespace(StringHelper::dirname($path));
        $classname = StringHelper::basename($path);
        return [
            'namespace'   => $namespace,
            'classname'   => $classname,
            'uses'        => [
                'Hyperf\HttpServer\Annotation\Controller',
                'Lengbin\Hyperf\Auth\RouterAuthAnnotation',
                'Lengbin\Hyperf\Common\Framework\BaseController',
            ],
            'comments'    => [
                'Class AdminController',
                '@package App\Controller',
                '@Controller()',
                '@RouterAuthAnnotation(isPublic=true)',
            ],
            'inheritance' => 'BaseController',
            'properties'  => [

            ],
            'methods'     => [

            ],
        ];
    }

    protected function servicePhpFile(string $path, array $actions): array
    {
        return [
            'namespace'   => 'App\Controller',
            'classname'   => 'AdminController',
            'uses'        => [
                'Hyperf\HttpServer\Annotation\Controller',
                'Lengbin\Hyperf\Auth\RouterAuthAnnotation',
                'Lengbin\Hyperf\Common\Framework\BaseController',
            ],
            'comments'    => [
                'Class AdminController',
                '@package App\Controller',
                '@Controller()',
                '@RouterAuthAnnotation(isPublic=true)',
            ],
            'inheritance' => 'BaseController',
            'properties'  => [

            ],
            'methods'     => [

            ],
        ];
    }

    protected function modelPhpFile(string $path, string $pool): array
    {
        $model = new GenerateModel();
        $model->create('ad');
    }

    public function file(GenerateCodeEntity $generateCodeEntity)
    {
        $this->controllerPhpFile($generateCodeEntity->getController(), $generateCodeEntity->getActions());
        $this->servicePhpFile($generateCodeEntity->getService(), $generateCodeEntity->getActions());
        $this->modelPhpFile($generateCodeEntity->getModel(), $generateCodeEntity->getPool());
    }
}
