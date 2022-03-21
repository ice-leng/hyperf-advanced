<?php
/**
 * Created by PhpStorm.
 * Date:  2022/3/21
 * Time:  4:35 PM
 */

declare(strict_types=1);

namespace App\Entity\Request;

use Hyperf\ApiDocs\Annotation\ApiFileProperty;
use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Hyperf\DTO\Annotation\Validation\Integer;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Lengbin\Common\Annotation\ArrayType;
use Lengbin\Common\BaseObject;

class DemoFileRequest extends BaseObject
{

    #[ApiModelProperty('key')]
    public string $key;

    #[ApiFileProperty('文件')]
    #[ArrayType(className: UploadedFile::class)]
    public array $file;

    #[ApiModelProperty('key2')]
    public string $key2;
}
