<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  5:13 下午
 */

declare(strict_types=1);

namespace App\Kernel\Log;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Snowflake\IdGenerator\SnowflakeIdGenerator;
use Hyperf\Utils\Context;
use Hyperf\Utils\Coroutine;
use Monolog\Processor\ProcessorInterface;

class AppendRequestIdProcessor implements ProcessorInterface
{

    const REQUEST_ID = 'log.request.id';

    /**
     * @Inject()
     * @var SnowflakeIdGenerator
     */
    protected SnowflakeIdGenerator $idGenerator;

    public function __invoke(array $record)
    {
        $record['context']['request_id'] = Context::getOrSet(self::REQUEST_ID, $this->idGenerator->generate());
        $record['context']['coroutine_id'] = Coroutine::id();
        return $record;
    }
}
