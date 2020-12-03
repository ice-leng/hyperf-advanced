<?php

namespace App\Component\AntDesign\Form;

use App\Component\AntDesign\Constant\Type\InputType;
use Lengbin\Common\Component\BaseObject;

class Form extends BaseObject
{
    /**
     * @var string
     */
    private $title = '';

    /**
     * @var array
     */
    private $item;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Form
     */
    public function setTitle(string $title): Form
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getItem(): array
    {
        return $this->item;
    }

    /**
     * @param array $item
     *
     * @return Form
     */
    public function setItem(array $item): Form
    {
        $data = [];
        foreach ($item as $form) {
            $type = $form['inputType'];
            $class = __NAMESPACE__ . '\\' . InputType::byName(strtoupper($type))->getValue();
            $data[] = new $class($form);
        }
        $this->item = $data;
        return $this;
    }
}
