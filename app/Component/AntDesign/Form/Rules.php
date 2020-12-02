<?php

namespace App\Component\AntDesign\Form;

use Lengbin\Common\Component\BaseObject;

/**
 * 表单规则
 * todo 待添加
 *
 * @package App\Component\AntDesign\Form
 */
class Rules extends BaseObject
{
    /**
     * @var bool
     */
    private $required;

    /**
     * @var string
     */
    private $message;

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     *
     * @return Rules
     */
    public function setRequired(bool $required): Rules
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Rules
     */
    public function setMessage(string $message): Rules
    {
        $this->message = $message;
        return $this;
    }
}
