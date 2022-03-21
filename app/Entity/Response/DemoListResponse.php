<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/18
 * Time:  3:50 PM
 */

declare(strict_types=1);

namespace App\Entity\Response;

use App\Entity\Url;
use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Lengbin\Common\Annotation\ArrayType;
use Lengbin\Common\Annotation\EnumView;
use Lengbin\Common\BaseObject;
use Lengbin\Hyperf\Common\Constants\WhetherStatus;

class DemoListResponse extends BaseObject
{
    #[ApiModelProperty('名称')]
    public ?string $name = '';

    #[ApiModelProperty('年龄')]
    public ?int $age = 1;

    #[ApiModelProperty('年龄2')]
    #[ArrayType(type: "int")]
    public array $ages;

    #[ApiModelProperty('状态')]
    #[EnumView]
    #[ArrayType(className: WhetherStatus::class)]
    public WhetherStatus $status;

    #[ApiModelProperty('状态2')]
    #[EnumView]
    #[ArrayType(className: WhetherStatus::class)]
    public array $states;

    #[ApiModelProperty('地址')]
    #[ArrayType(className: Address::class)]
    public array $addressArr = [];

    #[ApiModelProperty('图片')]
    public Url $image;
}
