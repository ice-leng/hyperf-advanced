<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    protected $formatter;

    public function __construct(StdoutLoggerInterface $logger, FormatterInterface $formatter)
    {
        $this->logger = $logger;
        $this->formatter = $formatter;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
//        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
//        $this->logger->error($throwable->getTraceAsString());
//        return $response->withStatus(500)->withBody(new SwooleStream('Internal Server Error.'));

        $this->logger->error($this->formatter->format($throwable));

        //格式化输出
        $code = $throwable->getCode();
        $results = [
            'code'    => $code === 0 ? 500 : $code,
            'type'    => get_class($throwable),
            'message' => $throwable->getMessage(),
        ];
        if ($code === 0) {
            $results['file'] = $throwable->getFile();
            $results['line'] = $throwable->getLine();
        }
        $data = Json::encode($results);
        return $response->withStatus(200)->withAddedHeader('content-type', 'application/json; charset=utf-8')->withBody(new SwooleStream($data));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
