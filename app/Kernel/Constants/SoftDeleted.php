<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  11:33 下午
 */

declare(strict_types=1);

namespace App\Kernel\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 软删除状态
 * @Constants()
 */
class SoftDeleted
{
    /**
     * @Message("正常")
     */
    const ENABLE = 1;

    /**
     * @Message("删除")
     */
    const DISABLE = 0;
}
