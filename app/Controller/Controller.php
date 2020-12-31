<?php

namespace App\Controller;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\Context;
use Lengbin\Auth\User\UserInterface;
use Lengbin\Hyperf\Common\Framework\BaseController;

class Controller extends BaseController
{
    /**
     * auth
     * @return UserInterface
     */
    public function getAuth(): UserInterface
    {
        $config = $this->container->get(ConfigInterface::class);
        $requestName = $config->get('auth.api.requestName', 'api');
        return $this->request->getAttribute($requestName);
    }

    /**
     * api dog validate data
     */
    public function getValidateData(): array
    {
        return Context::get('validator.data', []);
    }
}
