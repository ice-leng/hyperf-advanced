<?php

namespace Common\Controller;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Lengbin\Auth\User\UserInterface;
use Lengbin\Helper\Util\FormatHelper;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @Inject()
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject
     * @var ConfigInterface
     */
    protected $config;

    /**
     * 获得 user
     * @return UserInterface|null
     */
    abstract protected function getAuth(): ?UserInterface;

    /**
     *
     * refactoring page data and process params
     *
     * @param array $result
     * @param array $params
     *
     * @return array
     */
    protected function getList(array $result, array $params = [])
    {
        return FormatHelper::formatPage($result, $params, $this->request->input('page', 1));
    }
}
