<?php

namespace App\Component\Generate\Build\Model\Hyperf;

use App\Component\Generate\Build\BaseBuild;
use App\Component\Generate\Build\Collection\BaseBuildCollection;
use App\Component\Generate\Build\Collection\ModelBuildCollection;
use Lengbin\Helper\YiiSoft\StringHelper;
use Lengbin\Hyperf\Common\Component\Generate\Model\GenerateModel;

class ModelBuild extends BaseBuild
{
    public function build(): ModelBuildCollection
    {
        $class = $this->getNamespace($this->getGenerateCodeEntity()->getModel());
        $table = StringHelper::basename($class);
        $model = new GenerateModel();
        $data = $model->create($table, $this->getGenerateCodeEntity()->getPool(), StringHelper::dirname($this->getGenerateCodeEntity()->getModel()));
        return new ModelBuildCollection($data[$table]);
    }
}
