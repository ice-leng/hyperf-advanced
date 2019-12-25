<?php

declare(strict_types=1);

namespace Common\Auth;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class AuthAnnotation extends AbstractAnnotation
{
    // 是否为公共访问， 不走auth验证
    public $isPublic = false;

    // 是否为白名单， 走auth验证，如果不存在token不报错
    public $isWhitelist = false;

    // json 格式化 统一输出
    public $isJsonFormat = true;
}