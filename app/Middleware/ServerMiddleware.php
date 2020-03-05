<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helper\CodeHelper;
use FastRoute\Dispatcher;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Exception\Http\NotFoundException;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Context;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Hyperf\Auth\AuthAnnotation;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ServerMiddleware implements MiddlewareInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function isJsonFormat(Dispatched $dispatched)
    {
        [$class, $method] = $dispatched->handler->callback;
        $classMethodAnnotations = AnnotationCollector::getClassMethodAnnotation($class, $method);
        if (empty($classMethodAnnotations) || !ArrayHelper::keyExists($classMethodAnnotations, AuthAnnotation::class)) {
            return true;
        }
        /**
         * @var AuthAnnotation $authAnnotation
         */
        $authAnnotation = $classMethodAnnotations[AuthAnnotation::class];
        return $authAnnotation->isJsonFormat;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @throws \Nette\Utils\JsonException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $dispatched = $request->getAttribute(Dispatched::class);
        switch ($dispatched->status) {
            case Dispatcher::NOT_FOUND:
                $path = $request->getUri()->getPath();
                if ($path !== '/favicon.ico') {
                    throw new NotFoundException(CodeHelper::getMessage(CodeHelper::SYS_REQUEST_ERROR), CodeHelper::SYS_REQUEST_ERROR);
                }
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new NotFoundException(sprintf('Method `%s` is not defined', $request->getMethod()), CodeHelper::SYS_METHOD_NOT_ALLOWED);
                break;
            case Dispatcher::FOUND:
                $response = $handler->handle($request);
                if ($this->isJsonFormat($dispatched)) {
                    $content = $response->getBody()->getContents();
                    [$status, $jsonString] = \PHPUnit\Util\Json::canonicalize($content);
                    if (!$status) {
                        $data = Json::decode($jsonString);
                        $data = [
                            'code'    => CodeHelper::SYS_SUCCESS,
                            'message' => CodeHelper::getMessage(CodeHelper::SYS_SUCCESS),
                            'data'    => $data,
                        ];
                        $response = Context::override(ResponseInterface::class, function (ResponseInterface $response) use ($data) {
                            return $response->withAddedHeader('content-type', 'application/json; charset=utf-8')->withBody(new SwooleStream(Json::encode($data)));
                        });
                    }
                }
                return $response;
                break;
        }
    }
}
