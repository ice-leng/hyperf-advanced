<?php

namespace App\Component\Generate\Build\Collection;

use Lengbin\Helper\YiiSoft\Arrays\ArrayHelper;

class ErrorCodeBuildCollection extends BaseBuildCollection
{
    /**
     * @var array
     */
    private $constants;

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param array $constants
     *
     * @return ErrorCodeBuildCollection
     */
    public function setConstants(array $constants): ErrorCodeBuildCollection
    {
        $this->constants = $constants;
        return $this;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function getConstant(string $path): string
    {
        return ArrayHelper::get($this->getConstants(), $path);
    }
}
