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
namespace App\Entity\Request;

use App\Entity\PageRequest;
use Hyperf\ApiDocs\Annotation\ApiAttributeProperty;
use Hyperf\ApiDocs\Annotation\ApiHeaderProperty;
use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Hyperf\ApiDocs\Annotation\ApiQueryProperty;
use Lengbin\Common\BaseObject;

class DemoListRequest extends BaseObject
{
    #[ApiHeaderProperty("aaa")]
    protected string $header;

    #[ApiAttributeProperty("bbbb")]
    protected string $userId;

    #[ApiQueryProperty("ccc")]
    protected string $query;

    #[ApiModelProperty('关联条件')]
    public ?array $condition;

    #[ApiModelProperty('搜索条件')]
    public Search $search;

    #[ApiModelProperty('排序条件')]
    public ?array $sort;

    #[ApiModelProperty('分页数据')]
    public ?PageRequest $page;
}
