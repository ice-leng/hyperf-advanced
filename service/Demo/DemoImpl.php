<?php

namespace Service\Demo;

use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Helper\Service;

class DemoImpl extends Service implements DemoInterface
{

    /**
     * @Inject()
     * @var Demo
     */
    public $demo;

    /**
     * @param array $params
     * @param bool  $isAll
     *
     * @return array
     * @throws \Lengbin\YiiDb\Exception\Exception
     * @throws \Lengbin\YiiDb\Exception\InvalidConfigException
     * @throws \Lengbin\YiiDb\Exception\NotSupportedException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Throwable
     */
    public function getDemo(array $params = [], $isAll = false): array
    {
        return $this->demo->getDemo($params, $isAll);
    }
}
