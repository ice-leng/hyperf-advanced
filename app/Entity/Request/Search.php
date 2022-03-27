<?php
/**
 * Created by PhpStorm.
 * Date:  2022/2/16
 * Time:  11:32 AM
 */

declare(strict_types=1);

namespace App\Entity\Request;

use Hyperf\ApiDocs\Annotation\ApiAttributeProperty;
use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Hyperf\DTO\Annotation\Validation\Between;
use Hyperf\DTO\Annotation\Validation\In;
use Hyperf\DTO\Annotation\Validation\Integer;
use Hyperf\DTO\Annotation\Validation\Max;
use Hyperf\DTO\Annotation\Validation\Regex;
use Hyperf\DTO\Annotation\Validation\Required;
use Hyperf\DTO\Annotation\Validation\StartsWith;
use Hyperf\DTO\Annotation\Validation\Str;
use Lengbin\Common\BaseObject;

class Search extends BaseObject
{
    #[ApiModelProperty('测试')]
    public string $test = 'tt';

    #[ApiModelProperty('测试2')]
    public ?bool $isNew;

    #[ApiModelProperty('名称')]
    #[Max(5)]
    #[In(['qq', 'aa'])]
    public string $name;

    #[ApiModelProperty('正则')]
    #[Str]
    #[Regex('/^.+@.+$/i')]
    #[StartsWith('aa,bb')]
    #[max(10)]
    public string $email;

    #[ApiModelProperty('数量')]
    #[Integer]
    #[Between(1, 5)]
    #[Required]
    public int $num;

    #[ApiAttributeProperty("bbbb")]
    protected ?string $userId;
}
