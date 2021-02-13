<?php

namespace App\Component\Generate\Build\Collection;

class ControllerBuildCollection extends BaseBuildCollection
{
    /**
     * @var array
     */
    private $rout;

    /**
     * @return array
     */
    public function getRout(): array
    {
        return $this->rout;
    }

    /**
     * @param array $rout
     *
     * @return ControllerBuildCollection
     */
    public function setRout(array $rout): ControllerBuildCollection
    {
        $this->rout = $rout;
        return $this;
    }
}
