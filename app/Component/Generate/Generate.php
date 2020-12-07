<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

class Generate extends BaseObject
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Template
     */
    private $template;

    /**
     * 输出目录
     * @var string
     */
    private $output;
}
