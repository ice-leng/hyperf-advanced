<?php

namespace App\Service\System;

use App\Component\Generate\Build\Config\BuildConfig;
use App\Component\Generate\Build\ControllerBuild;
use App\Component\Generate\Build\ErrorCodeBuild;
use App\Component\Generate\Build\Model\Hyperf\ModelBuild;
use App\Component\Generate\Build\ServiceBuild;
use App\Entity\GenerateCodeEntity;
use Exception;
use Lengbin\Hyperf\Common\Framework\BaseService;

class GenerateService extends BaseService
{
    /**
     * @param GenerateCodeEntity $generateCodeEntity
     *
     * @return array
     * @throws Exception
     */
    public function crud(GenerateCodeEntity $generateCodeEntity): array
    {
        $params = [
            'config'             => new BuildConfig($this->config->get('genCode', [])),
            'root'               => BASE_PATH,
            'generateCodeEntity' => $generateCodeEntity,
        ];
        $model = (new ModelBuild($params))->build();
        $errorCode = (new ErrorCodeBuild($params))->setModel($model)->build();
        $service = (new ServiceBuild($params))->setModel($model)->setErrorCode($errorCode)->build();
        $controller = (new ControllerBuild($params))->setErrorCode($errorCode)->setService($service)->build();
        return [
            'file' => [
                'model'      => $model->getFile(),
                'service'    => $service->getFile(),
                'controller' => $controller->getFile(),
                'errorCode'  => $errorCode->getFile(),
            ],
            'rout' => $controller->getRout(),
        ];
    }

    public function html(GenerateCodeEntity $generateCodeEntity): array
    {
        // todo 未实现 前端代码 自动生成
    }
}
