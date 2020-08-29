<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;
use Lengbin\Jwt\JwtInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller()
 */
class IndexController extends AuthController
{

    /**
     * @Inject()
     * @var JwtInterface
     */
    public $jwt;

    /**
     * @RequestMapping(path="/", methods={"get"})
     *
     * @return mixed
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $token = $this->jwt->generate(['user_id' => 1, 'a' => 1]);
        return $this->success([
            'method'  => $method,
            'message' => "Hello {$user}.",
            'token'   => $token,
        ]);
    }

    /**
     * @RequestMapping(path="/user", methods={"get"})
     */
    public function user()
    {
        return $this->success($this->getAuth()->getId());
    }

    /**
     * @RequestMapping(path="/test", methods={"get"})
     * @RouterAuthAnnotation(isWhitelist=true)
     */
    public function test()
    {
        return $this->success([]);
    }

}
