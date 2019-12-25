<?php

declare(strict_types=1);

namespace Common\Helper;

/**
 * Created by PhpStorm.
 * User: lengbin
 * Date: 2017/2/2
 * Time: 下午4:57
 */
class ConstantHelper
{
    const NOT_DELETE = 0;

    //  性别
    const USER_GENDER_UNDEFINED = 0;
    const USER_GENDER_MAN = 1;
    const USER_GENDER_WOMAN = 2;

    // 登录类型
    const USER_LOGIN_TYPE_IN = 1;
    const USER_LOGIN_TYPE_OUT = 2;

    //支付类型
    const ORDER_PAY_TYPE_ALIPAY = 1;
    const ORDER_PAY_TYPE_WX = 2;
    const ORDER_PAY_TYPE_WALLET = 3;
}