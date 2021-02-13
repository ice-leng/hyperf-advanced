<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;

abstract class AbstractConfig extends BaseObject
{
    /**
     * file name
     * @return string
     */
    abstract public function getFileName(): string;

    /**
     * content
     * @return string
     */
    abstract public function getContent(): string;

    /**
     * @param int $level
     *
     * @return string
     */
    public function getSpaces(int $level = 1): string
    {
        return str_repeat(' ', $level * 4);
    }
}
