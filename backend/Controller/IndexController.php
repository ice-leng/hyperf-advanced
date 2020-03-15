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

namespace Backend\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Service\Demo\DemoInterface;

/**
 * Class IndexController
 * @package Backend\Controller
 * @Controller(server="backend")
 */
class IndexController extends BaseController
{

    /**
     * @Inject()
     * @var DemoInterface
     */
    protected $demo;

    /**
     * @RequestMapping(path="/", methods={"get", "post"})
     * @return array
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method'  => $method,
            'message' => "Hello {$user}.",
            'data'    => $this->getList($this->demo->getDemo($this->request->getQueryParams())),
        ];
    }

}
