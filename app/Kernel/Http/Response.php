<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/3
 * Time:  10:55 上午
 */

declare(strict_types=1);

namespace App\Kernel\Http;

use Hyperf\HttpMessage\Cookie\Cookie;
use Hyperf\HttpMessage\Stream\SwooleFileStream;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Exception\Http\EncodingException;
use Hyperf\HttpServer\Exception\Http\FileException;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Context;
use Hyperf\Utils\MimeTypeExtensionGuesser;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use SplFileInfo;
use stdClass;

class Response extends \Hyperf\HttpServer\Response
{

    public function success($data = [], string $msg = ''): PsrResponseInterface
    {
        return $this->json([
            'code' => "0",
            'msg'  => $msg,
            'data' => empty($data) ? new stdClass() : $data,
        ]);
    }

    public function fail($code, $message = ''): PsrResponseInterface
    {
        return $this->json([
            'code' => $code,
            'msg'  => $message,
            'data' => new stdClass(),
        ]);
    }

    public function cookie(Cookie $cookie)
    {
        $response = $this->withCookie($cookie);
        Context::set(PsrResponseInterface::class, $response);
        return $this;
    }


    public function header(string $name, string $value)
    {
        $response = $this->withAddedHeader($name, $value);
        Context::set(PsrResponseInterface::class, $response);
        return $this;
    }

    protected function toJson($data): string
    {
        try {
            $result = Json::encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Throwable $exception) {
            throw new EncodingException($exception->getMessage(), $exception->getCode());
        }

        return $result;
    }

    public function raw($data): PsrResponseInterface
    {
        return $this->getResponse()
            ->withBody(new SwooleStream((string) $data));
    }

    public function fileFlow(string $file)
    {
        $file = new SplFileInfo($file);
        if (! $file->isReadable()) {
            throw new FileException('File must be readable.');
        }
        $contentType = value(function () use ($file) {
            $mineType = null;
            if (ApplicationContext::hasContainer()) {
                $guesser = ApplicationContext::getContainer()->get(MimeTypeExtensionGuesser::class);
                $mineType = $guesser->guessMimeType($file->getExtension());
            }
            return $mineType ?? 'application/octet-stream';
        });

        return $this->getResponse()
            ->withAddedHeader('content-type', $contentType)
            ->withBody(new SwooleFileStream($file));
    }
}
