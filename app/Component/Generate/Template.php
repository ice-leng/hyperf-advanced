<?php

namespace App\Component\Generate;

use Lengbin\Common\Component\BaseObject;
use Smarty;
use SmartyException;

class Template extends BaseObject
{

    /**
     * @var Smarty
     */
    protected $smarty;

    /**
     *
     */
    public function init()
    {
        $dir = __DIR__ . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR;
        $temp = sys_get_temp_dir();
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir($dir);
        $this->smarty->setCacheDir("{$temp}/smarty/cache/");
        $this->smarty->setCompileDir("{$temp}/smarty/compile/");
        $this->smarty->setLeftDelimiter('{{');
        $this->smarty->setRightDelimiter('}}');
    }

    /**
     * @param string $template
     * @param array  $data
     *
     * @return string|null
     * @throws SmartyException
     */
    protected function render(string $template, array $data = []): ?string
    {
        foreach ($data as $key => $item) {
            $this->smarty->assign($key, $item);
        }

        return $this->smarty->fetch($template);
    }

    /**
     * 增删改查
     *
     * @param array $params
     *
     * @return string|null
     * @throws SmartyException
     */
    public function generateCurd(array $params = []): ?string
    {
        return $this->render('Curd.tpl', $params);
    }

}
