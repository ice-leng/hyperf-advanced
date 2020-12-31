<?php

namespace App\Component\AntDesign\Constant\Type;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class FormMethod extends BaseEnum
{
    /**
     * @Message("GET")
     */
    public const GET = 'get';

    /**
     * @Message("POST")
     */
    public const POST = 'post';

    /**
     * @Message("DELETE")
     */
    public const DELETE = 'delete';

    /**
     * @Message("PUT")
     */
    public const PUT = 'put';

    /**
     * @Message("OPTION")
     */
    public const OPTION = 'option';
}
