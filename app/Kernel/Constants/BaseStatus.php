<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/3
 * Time:  12:15 上午
 */

declare(strict_types=1);

namespace App\Kernel\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 基础状态
 * @Constants()
 */
class BaseStatus
{
    /**
     * @Message("禁用")
     */
    const FROZEN = 0;

    /**
     * @Message("正常")
     */
    const NORMAL = 1;
}
