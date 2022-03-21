<?php
/**
 * Created by PhpStorm.
 * Date:  2022/3/20
 * Time:  9:27 AM
 */

declare(strict_types=1);

namespace App\Entity;


class Url
{
    public string $path;

    public string $url;

    public function __construct(string $path = '')
    {
        $this->path = $path;
        $this->url = $path;
    }
}
