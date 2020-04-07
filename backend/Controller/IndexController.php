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

use Common\Controller\WebController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Lengbin\Hyperf\Auth\AuthAnnotation;
use Service\Demo\DemoInterface;

/**
 * Class IndexController
 * @package Backend\Controller
 * @Controller(server="backend")
 */
class IndexController extends WebController
{

    /**
     * @Inject()
     * @var DemoInterface
     */
    protected $demo;

    /**
     * @RequestMapping(path="/", methods={"get", "post"})
     * @AuthAnnotation(isPublic=true)
     * @return string
     */
    public function index()
    {
        return $this->render(['name' => '我是谁']);
    }

}
