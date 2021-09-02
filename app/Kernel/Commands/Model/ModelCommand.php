<?php
/**
 * Created by PhpStorm.
 * Date:  2021/8/5
 * Time:  7:02 下午
 */

namespace App\Kernel\Commands\Model;

use Hyperf\Database\Commands\Ast\ModelRewriteConnectionVisitor;
use Hyperf\Database\Commands\ModelCommand as BaseModelCommand;
use Hyperf\Database\Commands\ModelData;
use Hyperf\Database\Commands\ModelOption;
use Hyperf\Utils\CodeGen\Project;
use Hyperf\Utils\Str;
use PhpParser\NodeTraverser;

class ModelCommand extends BaseModelCommand
{

    protected function getPrimaryKey(array $columns): string
    {
        $primaryKey = 'id';
        foreach ($columns as $column) {
            if ($column['column_key'] === 'PRI') {
                $primaryKey = $column['column_name'];
                break;
            }
        }
        return $primaryKey;
    }

    protected function createModel(string $table, ModelOption $option)
    {
        $builder = $this->getSchemaBuilder($option->getPool());
        $table = Str::replaceFirst($option->getPrefix(), '', $table);
        $columns = $this->formatColumns($builder->getColumnTypeListing($table));

        $project = new Project();
        $class = $option->getTableMapping()[$table] ?? Str::studly(Str::singular($table));
        $class = $project->namespace($option->getPath()) . $class;
        $path = BASE_PATH . '/' . $project->path($class);

        if (! file_exists($path)) {
            $this->mkdir($path);
            file_put_contents($path, $this->buildClassPrimaryKey($table, $class, $this->getPrimaryKey($columns), $option));
        }

        $columns = $this->getColumns($class, $columns, $option->isForceCasts());

        $stms = $this->astParser->parse(file_get_contents($path));
        $traverser = new NodeTraverser();
        $traverser->addVisitor(make(ModelUpdateVisitor::class, [
            'class' => $class,
            'columns' => $columns,
            'option' => $option,
        ]));
        $traverser->addVisitor(make(ModelRewriteConnectionVisitor::class, [$class, $option->getPool()]));
        $data = make(ModelData::class)->setClass($class)->setColumns($columns);
        foreach ($option->getVisitors() as $visitorClass) {
            $traverser->addVisitor(make($visitorClass, [$option, $data]));
        }
        $stms = $traverser->traverse($stms);
        $code = $this->printer->prettyPrintFile($stms);

        file_put_contents($path, $code);
        $this->output->writeln(sprintf('<info>Model %s was created.</info>', $class));

        if ($option->isWithIde()) {
            $this->generateIDE($code, $option, $data);
        }
    }

    protected function replacePrimaryKey(string &$stub, string $primaryKey): self
    {
        $stub = str_replace(['%PRIMARY_KEY%'], [$primaryKey], $stub);

        return $this;
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClassPrimaryKey(string $table, string $name, string $primaryKey, ModelOption $option): string
    {
        $stub = file_get_contents(__DIR__ . '/stubs/Model.stub');

        return $this->replaceNamespace($stub, $name)
            ->replaceInheritance($stub, $option->getInheritance())
            ->replaceConnection($stub, $option->getPool())
            ->replaceUses($stub, $option->getUses())
            ->replaceClass($stub, $name)
            ->replacePrimaryKey($stub, $primaryKey)
            ->replaceTable($stub, $table);
    }
}
