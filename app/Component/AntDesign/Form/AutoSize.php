<?php

namespace App\Component\AntDesign\Form;

use Lengbin\Common\Component\BaseObject;

/**
 * 多行文本域 的 大小
 * @package App\Component\AntDesign\Form
 */
class AutoSize extends BaseObject
{
    /**
     * 最小
     * @var int
     */
    private $minRows;

    /**
     * 最大
     * @var int
     */
    private $maxRows;

    /**
     * @return int
     */
    public function getMinRows(): int
    {
        return $this->minRows;
    }

    /**
     * @param int $minRows
     *
     * @return AutoSize
     */
    public function setMinRows(int $minRows): AutoSize
    {
        $this->minRows = $minRows;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxRows(): int
    {
        return $this->maxRows;
    }

    /**
     * @param int $maxRows
     *
     * @return AutoSize
     */
    public function setMaxRows(int $maxRows): AutoSize
    {
        $this->maxRows = $maxRows;
        return $this;
    }
}
