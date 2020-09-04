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

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller()
 */
class IndexController extends AuthController
{

    /**
     * @RequestMapping(path="/", methods={"get"})
     * @RouterAuthAnnotation(isPublic=true)
     *
     * @return mixed
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        return $this->success([
            'method'  => $method,
            'message' => "Hello {$user}.",
        ]);
    }

    /**
     * @RequestMapping(path="/user", methods={"get"})
     */
    public function user()
    {
        return $this->success([
            'abc' => $this->getAuth()->getId(),
        ]);
    }

    /**
     * @RequestMapping(path="/test", methods={"get"})
     * @RouterAuthAnnotation(isWhitelist=true)
     */
    public function test()
    {
        return $this->success([
            'abc' => $this->getAuth()->getId(),
        ]);
    }

}
