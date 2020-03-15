<?php

namespace Service\Demo;

/**
 * Interface DemoInterface
 * @package Service\Demo
 *
 */
interface DemoInterface
{

    /**
     * demo list
     *
     * @param array $params
     * @param bool  $isAll
     *
     * @return array
     */
    public function getDemo(array $params = [], $isAll = false): array;
}
