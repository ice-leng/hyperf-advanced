<?php

namespace App\Entity;

use App\Component\AntDesign\Form\Form;
use App\Component\AntDesign\Link;
use App\Component\AntDesign\Table;
use Lengbin\Common\Component\BaseObject;

class GenerateCodeEntity extends BaseObject
{
    /**
     * 控制 path
     * @var string
     */
    private $controller;

    /**
     * 模型 path
     * @var string
     */
    private $model;

    /**
     * 连接池
     * @var string
     */
    private $pool;

    /**
     * 服务 path
     * @var string
     */
    private $service;

    /**
     * 按钮
     * @var Link[]
     */
    private $actions;

    /**
     * 列表
     * @var Table
     */
    private $table;

    /**
     * 列表 搜索
     * @var array
     */
    private $search;

    /**
     * 表单
     *
     * @var Form
     */
    private $form;

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     *
     * @return GenerateCodeEntity
     */
    public function setController(string $controller): GenerateCodeEntity
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     *
     * @return GenerateCodeEntity
     */
    public function setModel(string $model): GenerateCodeEntity
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     *
     * @return GenerateCodeEntity
     */
    public function setService(string $service): GenerateCodeEntity
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return Link[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @param Link[] $actions
     *
     * @return GenerateCodeEntity
     */
    public function setActions(array $actions): GenerateCodeEntity
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * @param Table $table
     *
     * @return GenerateCodeEntity
     */
    public function setTable(Table $table): GenerateCodeEntity
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return array
     */
    public function getSearch(): array
    {
        return $this->search;
    }

    /**
     * @param array $search
     *
     * @return GenerateCodeEntity
     */
    public function setSearch(array $search): GenerateCodeEntity
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return GenerateCodeEntity
     */
    public function setForm(Form $form): GenerateCodeEntity
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getPool(): string
    {
        return $this->pool;
    }

    /**
     * @param string $pool
     *
     * @return GenerateCodeEntity
     */
    public function setPool(string $pool): GenerateCodeEntity
    {
        $this->pool = $pool;
        return $this;
    }
}
