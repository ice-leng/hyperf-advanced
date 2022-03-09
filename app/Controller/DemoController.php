<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/18
 * Time:  11:38 AM.
 */

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

use App\Entity\Request\DemoListRequest;
use App\Entity\Response\DemoListResponse;
use App\Middleware\TokenMiddleware;
use Hyperf\ApiDocs\Annotation\Api;
use Hyperf\ApiDocs\Annotation\ApiHeader;
use Hyperf\ApiDocs\Annotation\ApiOperation;
use Hyperf\ApiDocs\Annotation\ApiResponse;
use Hyperf\DTO\Annotation\Contracts\RequestBody;
use Hyperf\DTO\Annotation\Contracts\Valid;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Lengbin\Hyperf\Common\BaseController;
use Psr\Http\Message\ResponseInterface;

#[Controller(prefix: "/demo")]
#[Api(tags: "demo管理", position: 0)]
#[ApiHeader(name: 'Authorization')]
#[Middleware(TokenMiddleware::class)]
class DemoController extends BaseController
{

    #[ApiOperation('查询')]
    #[PostMapping(path: 'query')]
    #[ApiResponse(code: '200', description: 'success', template: "page", className: DemoListResponse::class)]
    public function query(#[RequestBody] #[Valid] DemoListRequest $request): ResponseInterface
    {
        var_dump($request);
        return $this->response->success();
    }

}
