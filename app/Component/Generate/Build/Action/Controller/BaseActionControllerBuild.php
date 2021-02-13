<?php

namespace App\Component\Generate\Build\Action\Controller;

use App\Component\Generate\Build\Action\BaseActionBuild;
use App\Component\Generate\Build\Action\Controller\ValidateParse\BaseValidateParse;
use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;

abstract class BaseActionControllerBuild extends BaseActionBuild
{
    public function getUses(): array
    {
        return [];
    }

    public function getParams(): array
    {
        return [];
    }

    public function getReturn(): string
    {
        return '';
    }

    public function getComment(): array
    {
        return $this->getValidateParse()->parse();
    }

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var BaseValidateParse
     */
    private $validateParse;


    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     *
     * @return BaseActionControllerBuild
     */
    public function setServiceName(string $serviceName): BaseActionControllerBuild
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    /**
     * @return BaseValidateParse
     */
    public function getValidateParse(): BaseValidateParse
    {
        return $this->validateParse;
    }

    /**
     * @param BaseValidateParse $validateParse
     *
     * @return BaseActionControllerBuild
     */
    public function setValidateParse(BaseValidateParse $validateParse): BaseActionControllerBuild
    {
        $this->validateParse = $validateParse;
        return $this;
    }
}
