<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Column\ValueEnum;
use App\Component\AntDesign\Column\ValueEnumType;

class FormCheckbox extends BaseForm
{
    /**
     * 初始是否选中
     * @var bool
     */
    private $defaultChecked;

    /**
     * 当前列值的枚举
     * @var ValueEnum[]
     * @see valueType
     */
    private $valueEnum;

    /**
     * @return bool
     */
    public function getDefaultChecked(): bool
    {
        return $this->defaultChecked;
    }

    /**
     * @param bool $defaultChecked
     *
     * @return FormCheckbox
     */
    public function setDefaultChecked(bool $defaultChecked): FormCheckbox
    {
        $this->defaultChecked = $defaultChecked;
        return $this;
    }

    /**
     * @return array
     */
    public function getValueEnum(): array
    {
        return $this->valueEnum;
    }

    /**
     * @param ValueEnum[] $valueEnum
     *
     * @return FormCheckbox
     */
    public function setValueEnum(array $valueEnum): FormCheckbox
    {
        $drops = [];
        foreach ($valueEnum as $item) {
            $drops[$item->getKey()] = new ValueEnumType([
                'text'   => $item->getValue(),
                'status' => $item->getStatus(),
            ]);
        }
        $this->valueEnum = $drops;
        return $this;
    }
}
