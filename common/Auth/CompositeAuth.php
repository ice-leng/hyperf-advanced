<?php
declare(strict_types=1);

namespace Common\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Auth\AuthInterface;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;

/**
 * CompositeAuth allows multiple authentication methods at the same time.
 *
 * The authentication methods contained by CompositeAuth are configured via {@see setAuthMethods()},
 * which is a list of supported authentication class configurations.
 */
final class CompositeAuth implements AuthInterface
{
    /**
     * @var AuthInterface[]
     */
    private $authMethods = [];

    /**
     * @var IdentityRepositoryInterface
     */
    protected $identityRepository;

    public function __construct(IdentityRepositoryInterface $identityRepository)
    {
        $this->identityRepository = $identityRepository;
    }

    public function authenticate(ServerRequestInterface $request): ?IdentityInterface
    {
        foreach ($this->authMethods as $i => $auth) {
            if (!$auth instanceof AuthInterface) {
                $this->authMethods[$i] = $auth = make((string)$auth, [$this->identityRepository]);
                if (!$auth instanceof AuthInterface) {
                    throw new \RuntimeException(get_class($auth) . ' must implement ' . AuthInterface::class);
                }
            }

            $identity = $auth->authenticate($request);
            if ($identity !== null) {
                return $identity;
            }
        }

        return null;
    }

    public function challenge(ResponseInterface $response): ResponseInterface
    {
        foreach ($this->authMethods as $method) {
            $response = $method->challenge($response);
        }
        return $response;
    }

    public function setAuthMethods(array $methods): void
    {
        $this->authMethods = $methods;
    }
}
