<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Common\BaseController;
use Lengbin\Hyperf\Common\Helpers\IpHelper;

class IndexController extends BaseController
{

    /**
     * @Inject()
     * @var StdoutLoggerInterface
     */
    protected StdoutLoggerInterface $logger;

    /**
     * @Inject()
     * @var IpHelper
     */
    protected IpHelper $ipHelper;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        go(function () {
            $this->logger->info('ccccc');
        });

        $this->logger->info('zzzz');

        go(function () {
            $this->logger->info('vvv');
        });

        $this->logger->info('xxxx');
        $this->logger->info($this->ipHelper->getClientIp());

        return $this->response->success([
            'method'  => $method,
            'message' => "Hello {$user}.",
        ]);
    }
}
