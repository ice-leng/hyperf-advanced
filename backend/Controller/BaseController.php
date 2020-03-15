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

namespace Backend\Controller;

use Common\Controller\AbstractController;
use Lengbin\Auth\User\UserInterface;

class BaseController extends AbstractController
{
    /**
     * auth
     * @return UserInterface
     */
    public function getAuth(): ?UserInterface
    {
        $requestName = $this->config->get('auth.web.requestName');
        return $this->request->getAttribute($requestName);
    }

    /**
     * set flash
     *
     * @param $type
     * @param $message
     */
    public function setFlash($type, $message)
    {
        // todo
//        \Yii::$app->session->setFlash($type, $message);
    }

    /**
     * success alert
     *
     * @param string $message
     */
    public function successAlert($message = '保存成功')
    {
        $this->setFlash('success', $message);
    }

    /**
     *
     * info alert
     *
     * @param string $message
     */
    public function infoAlert($message)
    {
        $this->setFlash('info', $message);
    }

    /**
     * warning alert
     *
     * @param string $message
     */
    public function warningAlert($message)
    {
        $this->setFlash('warning', $message);
    }

    /**
     * error alert
     *
     * @param string $message
     */
    public function errorAlert($message = '保存失败')
    {
        $this->setFlash('error', $message);
    }

}
