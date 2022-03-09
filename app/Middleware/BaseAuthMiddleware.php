<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/20
 * Time:  10:50 AM
 */

declare(strict_types=1);

namespace App\Middleware;

use App\Module\Login\JwtSubject;
use App\Module\Login\LoginFactory;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Logger\LoggerFactory;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;
use Lengbin\Hyperf\Common\Annotation\RouterAuthAnnotation;
use Lengbin\Hyperf\Common\Constants\Errors\CommonError;
use Lengbin\Hyperf\Common\Exceptions\BusinessException;
use Lengbin\Hyperf\Common\Helpers\IpHelper;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class BaseAuthMiddleware implements MiddlewareInterface
{
    /**
     * @Inject()
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @Inject()
     * @var IpHelper
     */
    protected IpHelper $ipHelper;

    /**
     * @Inject()
     * @var LoginFactory
     */
    protected LoginFactory $loginFactory;

    /**
     * 检测注解路由
     *
     * @param ServerRequestInterface $request
     *
     * @return array
     */
    protected function checkRouter(ServerRequestInterface $request): array
    {
        /**
         * @var Dispatched $dispatched
         */
        $dispatched = $request->getAttribute(Dispatched::class);
        $annotation = RouterAuthAnnotation::class;
        $callback = $dispatched->handler->callback;
        [$class, $method] = is_array($callback) ? $callback : ['', ''];
        $annotations = AnnotationCollector::getClassMethodAnnotation($class, $method);
        $authAnnotation = ArrayHelper::get($annotations, $annotation);
        if (is_null($authAnnotation)) {
            $authAnnotation = AnnotationCollector::getClassAnnotation($class, $annotation);
        }

        $isPublic = $isWhitelist = false;
        if ($authAnnotation !== null) {
            $isPublic = $authAnnotation->isPublic;
            $isWhitelist = $authAnnotation->isWhitelist;
        }
        return [$isPublic, $isWhitelist];
    }

    /**
     * @param array  $data
     * @param string $name
     * @param string $group
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function logger(array $data, string $name = 'hyperf', string $group = 'default')
    {
        return $this->container->get(LoggerFactory::class)->get($name, $group)->info(json_encode($data,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * 获取Token
     *
     * @param ServerRequestInterface $request
     *
     * @return string
     */
    public function getToken(ServerRequestInterface $request): ?string
    {
        $token = $request->getHeaderLine('authorization');
        if (empty($token)) {
            $token = $request->getCookieParams()['authorization'] ?? '';
        }
        if (empty($token)) {
            $token = $request->getParsedBody()['authorization'] ?? '';
        }

        [$token] = sscanf($token, 'Bearer %s');
        return $token;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 记录请求日志
        $this->logger([
            'user-agent' => $request->getHeaderLine('user-agent'),
            'ip'         => $this->ipHelper->getClientIp(),
            'host'       => $request->getUri()->getHost(),
            'url'        => $request->getUri()->getPath(),
            'post'       => $request->getParsedBody(),
            'get'        => $request->getQueryParams(),
        ], 'request');

        [$isPublic, $isWhitelist] = $this->checkRouter($request);

        // 无需鉴权 1，公开的， 2白名单的
        $token = $this->getToken($request);
        if ($isPublic || (empty($token) && $isWhitelist)) {
            return $handler->handle($request);
        }
        $payload = $request->getHeaderLine('x-test-flag') == 1 ? $this->getTestPayload($request) : $this->validateToken($token);

        // 记录 jwt解析 日志
        $this->logger($payload->toArray(), 'request-payload');

        if ($payload->invalid) {
            throw new BusinessException(CommonError::INVALID_TOKEN);
        }

        if ($payload->expired) {
            throw new BusinessException(CommonError::TOKEN_EXPIRED);
        }

        return $handler->handle($this->handlePayload($request, $payload));
    }

    abstract protected function getTestPayload(ServerRequestInterface $request);

    abstract protected function validateToken(?string $token): JwtSubject;

    abstract protected function handlePayload(ServerRequestInterface $request, JwtSubject $payload): ServerRequestInterface;

    protected function parseToken(?string $token, callable $handler = null): JwtSubject
    {
        return call_user_func($handler, $this->loginFactory->verifyToken($token));
    }
}
