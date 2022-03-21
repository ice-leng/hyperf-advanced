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
use Hyperf\DTO\Annotation\Contracts\RequestBody;
use Hyperf\DTO\Annotation\Contracts\Valid;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Lengbin\Hyperf\Common\BaseController;

#[Controller(prefix: "/demo")]
#[Api(tags: "demo管理", position: 0)]
#[ApiHeader(name: 'Authorization')]
#[Middleware(TokenMiddleware::class)]
class DemoController extends BaseController
{

    #[ApiOperation('查询')]
    #[PostMapping(path: 'query')]
    public function query(#[RequestBody] #[Valid] DemoListRequest $request): DemoListResponse
    {
        var_dump($request);
        die;
        return new DemoListResponse([
            'ages'       => [1],
            'states'     => [1, 0],
            'status'     => 1,
            'image'      => 'https://www.baidu.com',
            'addressArr' => [
                [
                    'street' => "a",
                    'float' => 1.22,
                    'city'  => [
                        'cityName' => '成都'
                    ]
                ],
            ],
            'name'       => "demo",
            'age'        => 1,
        ]);
    }
}
