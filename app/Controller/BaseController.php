<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Common\Controller\AbstractController;
use Lengbin\Auth\User\UserInterface;
use Lengbin\Hyperf\Helper\CodeHelper;
use Lengbin\Hyperf\Helper\Exception\BusinessException;
use Lengbin\Hyperf\YiiDb\ActiveRecord;

class BaseController extends AbstractController
{
    /**
     * @inheritDoc
     */
    protected function getAuth(): ?UserInterface
    {
        $requestName = $this->config->get('auth.api.requestName');
        return $this->request->getAttribute($requestName);
    }

    /**
     * 参数无效异常
     *
     * @param string|null $message
     * @param int         $code
     */
    protected function invalidParamException(?string $message = null, $code = CodeHelper::SYS_PARAMS_ERROR)
    {
        throw new BusinessException($code, $message);
    }

    /**
     * 表单无效异常
     *
     * @param ActiveRecord $activeRecord
     */
    protected function invalidFormException(ActiveRecord $activeRecord)
    {
        $message = $activeRecord->getFirstErrors(false);
        $this->invalidParamException($message);
    }
}
