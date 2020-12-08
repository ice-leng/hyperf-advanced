<?php

namespace App\Component\Generate;

interface TemplateInterface
{
    /**
     * @param string $template
     * @param array  $data
     *
     * @return string|null
     */
    public function render(string $template, array $data = []): ?string;
}
