<?php

namespace App\Component\AntDesign\Form;

class FormTextPassword extends FormText
{
    /**
     * 是否显示切换按钮
     * @var bool
     */
    private $visibilityToggle;

    /**
     * @return bool
     */
    public function getVisibilityToggle(): bool
    {
        return $this->visibilityToggle;
    }

    /**
     * @param bool $visibilityToggle
     *
     * @return FormTextPassword
     */
    public function setVisibilityToggle(bool $visibilityToggle): FormTextPassword
    {
        $this->visibilityToggle = $visibilityToggle;
        return $this;
    }

}
