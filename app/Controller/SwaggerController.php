<?php

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Lengbin\Hyperf\Auth\AuthAnnotation;
use Lengbin\Hyperf\Swagger\Swagger;

/**
 * Class SwaggerController
 * @package App\Controller
 * @Controller()
 */
class SwaggerController extends AbstractController
{

    /**
     * @Inject()
     * @var Swagger
     */
    public $swagger;

    /**
     * @GetMapping(path="/swaager")
     * @AuthAnnotation(isPublic=true)
     */
    public function index()
    {
        return $this->swagger->html();
    }

    /**
     * @GetMapping(path="/swagger/api")
     * @AuthAnnotation(isPublic=true, isJsonFormat=false)
     */
    public function api()
    {
        // 扫码目录path
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'swagger';
        return $this->swagger->api([
            $path,
        ]);
    }

    /**
     * @GetMapping(path="/swagger/generator")
     * @AuthAnnotation(isPublic=true)
     */
    public function generator()
    {
        return $this->swagger->generator($this->request);
    }

    /**
     * @RequestMapping(path="/swagger/annotation", methods={"GET", "POST"})
     * @AuthAnnotation(isPublic=true)
     */
    public function annotation()
    {
        // 扫码目录path, 生成注释文档目录
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'swagger';
        return $this->swagger->annotation($this->request, $path);
    }

}
