<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/16
 * Time:  10:43 AM
 */

declare(strict_types=1);

namespace App\Entity\Response;

use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Hyperf\DTO\Annotation\Validation\Required;
use Lengbin\Common\BaseObject;

class Address extends BaseObject
{
    public string $street = '';

    #[ApiModelProperty('浮点数')]
    public float $float = 0.0;

    #[ApiModelProperty('城市')]
    #[Required]
    public ?City $city = null;
}
