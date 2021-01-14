<?php

namespace App\Service\System;

use App\Component\Generate\Build\BuildClass;
use App\Component\Generate\Build\Config\BuildConfig;
use App\Component\Generate\Build\ControllerBuild;
use App\Component\Generate\Build\ErrorCodeBuild;
use App\Component\Generate\Build\Model\HyperfModelBuild;
use App\Component\Generate\Build\ServiceBuild;
use App\Entity\GenerateCodeEntity;
use Lengbin\Hyperf\Common\Framework\BaseService;

class GenerateService extends BaseService
{
    public function crud(GenerateCodeEntity $generateCodeEntity): array
    {
        $config = new BuildConfig($this->config->get('genCode', []));
        $model = new HyperfModelBuild([
            'path' => $generateCodeEntity->getModel(),
            'pool' => $generateCodeEntity->getPool(),
        ]);
        $build = (new BuildClass())->setGenerateCodeEntity($generateCodeEntity)
            ->setRoot(BASE_PATH)
            ->setConfig($config)
            ->setModel($model)
            ->setService(new ServiceBuild())
            ->setErrorCode(new ErrorCodeBuild())
            ->setController(new ControllerBuild());
        return $build->run();
    }

    public function html(GenerateCodeEntity $generateCodeEntity): array
    {
        // todo 未实现 前端代码 自动生成
    }
}
