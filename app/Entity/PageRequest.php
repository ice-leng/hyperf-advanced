<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/18
 * Time:  3:27 PM.
 */

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Entity;

use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Lengbin\Common\BaseObject;

class PageRequest extends BaseObject
{
    #[ApiModelProperty('是否返回全部结果')]
    public ?int $all;

    #[ApiModelProperty('是否返回总数')]
    public ?int $total;

    #[ApiModelProperty('页码')]
    public ?int $page;

    #[ApiModelProperty('每页个数')]
    public ?int $page_size;
}
