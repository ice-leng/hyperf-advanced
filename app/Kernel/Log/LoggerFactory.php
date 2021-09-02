<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  5:34 下午
 */

declare(strict_types=1);

namespace App\Kernel\Log;

use Hyperf\Logger\LoggerFactory as HyperfLoggerFactory;
use Psr\Container\ContainerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return $container->get(HyperfLoggerFactory::class)->make();
    }
}
