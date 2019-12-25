<?php
declare(strict_types=1);

namespace Common\Middleware\Rest;

use Common\Auth\AuthAnnotation;
use Common\Auth\CompositeAuth;
use Common\Exception\BusinessException;
use Common\Helper\CodeHelper;
use FastRoute\Dispatcher;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Auth\AuthInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Strings\StringHelper;
use Yiisoft\Yii\Web\User\GuestIdentity;
use Yiisoft\Yii\Web\User\User;

/**
 * Class AuthMiddleware
 * thanks yii
 * @package Common\middleware\auth
 */
class AuthMiddleware implements MiddlewareInterface
{

    private const REQUEST_NAME = 'auth';

    private $requestName = self::REQUEST_NAME;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ContainerInterface $container, ConfigInterface $config)
    {
        $this->container = $container;
        $this->config = $config;
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
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $dispatched = $request->getAttribute(Dispatched::class);
        if ($dispatched->status !== Dispatcher::FOUND) {
            return $handler->handle($request);
        }

        $auth = $this->config->get('auth');
        if ($auth === null) {
            throw new \RuntimeException('please set auth config');
        }

        if (empty($auth['authenticator'])) {
            throw new \RuntimeException('please set auth config authenticator params');
        }

        if (empty($auth['identityClass'])) {
            throw new \RuntimeException('please set auth config identityClass params');
        }

        $identityClass = make($auth['identityClass']);

        if (!$identityClass instanceof IdentityRepositoryInterface) {
            throw new \RuntimeException($auth['identityClass'] . ' must implement ' . IdentityRepositoryInterface::class);
        }

        $authenticator = make($auth['authenticator'], [$identityClass]);

        if (!$authenticator instanceof AuthInterface) {
            throw new \RuntimeException($auth['authenticator'] . ' must implement ' . AuthInterface::class);
        }

        // 是否为 混合验证
        if ($authenticator instanceof CompositeAuth) {
            $authMethods = ArrayHelper::getValue($auth, 'authMethods', []);
            $authenticator->setAuthMethods($authMethods);
        }

        $this->setRequestName(ArrayHelper::getValue($auth, 'requestName', self::REQUEST_NAME));

        [$isPublic, $isWhitelist] = $this->checkRouter($dispatched);

        //不验证
        if ($isPublic === null) {
            $publicList = ArrayHelper::getValue($auth, 'public', []);
            $isPublic = $this->checkPath($request, $publicList);
        }

        //白名单
        if ($isWhitelist === null) {
            $whitelist = ArrayHelper::getValue($auth, 'whitelist', []);
            $isWhitelist = $this->checkPath($request, $whitelist);
        }

        $identity = $isPublic ? null : $authenticator->authenticate($request);

        $request = Context::override(ServerRequestInterface::class, function (ServerRequestInterface $request) use ($identityClass, $identity) {
            $eventDispatcher = $this->container->get(EventDispatcherInterface::class);
            $user = make(User::class, [$identityClass, $eventDispatcher]);
            if ($identity === null) {
                $identity = make(GuestIdentity::class);
            }
            $user->login($identity);
            return $request->withAttribute($this->requestName, $user);
        });

        if (!$isPublic && $identity === null && !$isWhitelist) {
            throw new BusinessException(CodeHelper::TOKEN_INVALID);
        }

        return $handler->handle($request);
    }

    /**
     * request name
     *
     * @param string $name
     */
    public function setRequestName(string $name): void
    {
        $this->requestName = $name;
    }

    /**
     * check url path
     *
     * @param ServerRequestInterface $request
     * @param array                  $patterns
     *
     * @return bool
     */
    protected function checkPath(ServerRequestInterface $request, array $patterns = []): bool
    {
        $status = false;
        $path = $request->getUri()->getPath();
        foreach ($patterns as $pattern) {
            if (StringHelper::matchWildcard($pattern, $path)) {
                $status = true;
                break;
            }
        }
        return $status;
    }

    /**
     * 检测路由
     *
     * @param Dispatched $dispatched
     *
     * @return array
     */
    protected function checkRouter($dispatched): array
    {
        list($class, $method) = $dispatched->handler->callback;
        $classMethodAnnotations = AnnotationCollector::getClassMethodAnnotation($class, $method);
        if (empty($classMethodAnnotations) || !ArrayHelper::keyExists($classMethodAnnotations, AuthAnnotation::class)) {
            return [null, null];
        }
        /**
         * @var AuthAnnotation $authAnnotation
         */
        $authAnnotation = $classMethodAnnotations[AuthAnnotation::class];
        return [$authAnnotation->isPublic, $authAnnotation->isWhitelist];
    }

}
