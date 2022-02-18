<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/18
 * Time:  3:50 PM
 */

declare(strict_types=1);

namespace App\Entity\Response;

use Hyperf\ApiDocs\Annotation\ApiModelProperty;

class DemoListResponse
{
    #[ApiModelProperty('名称')]
    public ?string $name = '';

    #[ApiModelProperty('年龄')]
    public ?int $age = 1;

    /**
     * @var Address[]
     */
    #[ApiModelProperty('地址')]
    public array $addressArr;
}
