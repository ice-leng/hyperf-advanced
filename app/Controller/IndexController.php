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

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Lengbin\Hyperf\Auth\AuthAnnotation;
use Lengbin\Jwt\TokenInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller()
 */
class IndexController extends AbstractController
{

    /**
     * @Inject()
     * @var TokenInterface
     */
    protected $jwt;

    /**
     * @RequestMapping(path="/", methods={"get", "post"})
     * @AuthAnnotation(isPublic=true)
     * @return array
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        return [
            'method'  => $method,
            'message' => "Hello {$user}.",
            'token' => $this->jwt->makeToken(["username"=> 'ice', 'face'=> ''], 12),
        ];
    }

    /**
     * @GetMapping(path="/test/{id:\d{1,3}}")
     * @AuthAnnotation(isWhitelist=true)
     */
    public function test($id)
    {
        return ['11' =>  $id];
    }

    /**
     * @GetMapping(path="/test2")
     */
    public function test2()
    {
        return [
            'id' => $this->getAuth()->getId()
        ];
    }

}
