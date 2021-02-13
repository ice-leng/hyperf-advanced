<?php

namespace App\Constant\Errors\System;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class GenerateError extends BaseEnum
{
    /**
     * @Message("错误字典生成文件失败")
     */
    public const ERROR_GENERATE_ERROR_CODE_CREATE_FAIL = 'B-001-005-001';

    /**
     * @Message("服务生成文件失败")
     */
    public const ERROR_GENERATE_SERVICE_CREATE_FAIL = 'B-001-005-002';

    /**
     * @Message("控制器生成文件失败")
     */
    public const ERROR_GENERATE_CONTROLLER_CREATE_FAIL = 'B-001-005-003';
}
