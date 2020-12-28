<?php

namespace App\Component\Generate\Model;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Database\Commands\Ast\GenerateModelIDEVisitor;
use Hyperf\Database\Commands\Ast\ModelRewriteConnectionVisitor;
use Hyperf\Database\Commands\Ast\ModelUpdateVisitor;
use Hyperf\Database\Commands\ModelData;
use Hyperf\Database\Commands\ModelOption;
use Hyperf\Database\ConnectionResolverInterface;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Schema\MySqlBuilder;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\CodeGen\Project;
use Hyperf\Utils\Str;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\PrettyPrinterAbstract;
use Psr\Container\ContainerInterface;

class GenerateModel
{
    /**
     * @Inject()
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var PrettyPrinterAbstract
     */
    protected $printer;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * @var Parser
     */
    protected $astParser;

    public function __construct()
    {
        $this->resolver = $this->container->get(ConnectionResolverInterface::class);
        $this->config = $this->container->get(ConfigInterface::class);
        $this->astParser = (new ParserFactory())->create(ParserFactory::ONLY_PHP7);
        $this->printer = new Standard();
    }

    /**
     * @param string $poolName
     *
     * @return MySqlBuilder
     */
    protected function getSchemaBuilder(string $poolName): MySqlBuilder
    {
        $connection = $this->resolver->connection($poolName);
        return $connection->getSchemaBuilder();
    }

    /**
     * Format column's key to lower case.
     *
     * @param array $columns
     *
     * @return array
     */
    protected function formatColumns(array $columns): array
    {
        return array_map(function ($item) {
            return array_change_key_case($item, CASE_LOWER);
        }, $columns);
    }

    /**
     * @param string $path
     */
    protected function mkdir(string $path): void
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    /**
     * Get the full namespace for a given class, without the class name.
     */
    protected function getNamespace(string $name): string
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Replace the namespace for the given stub.
     */
    protected function replaceNamespace(string &$stub, string $name): self
    {
        $stub = str_replace(['%NAMESPACE%'], [$this->getNamespace($name)], $stub);

        return $this;
    }

    protected function replaceInheritance(string &$stub, string $inheritance): self
    {
        $stub = str_replace(['%INHERITANCE%'], [$inheritance], $stub);

        return $this;
    }

    protected function replaceConnection(string &$stub, string $connection): self
    {
        $stub = str_replace(['%CONNECTION%'], [$connection], $stub);

        return $this;
    }

    protected function replacePrimaryKey(string &$stub, string $primaryKey): self
    {
        $stub = str_replace(['%PRIMARY_KEY%'], [$primaryKey], $stub);

        return $this;
    }

    protected function replaceUses(string &$stub, string $uses): self
    {
        $uses = $uses ? "use {$uses};" : '';
        $stub = str_replace(['%USES%'], [$uses], $stub);

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     */
    protected function replaceClass(string &$stub, string $name): self
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace('%CLASS%', $class, $stub);

        return $this;
    }

    /**
     * Replace the table name for the given stub.
     */
    protected function replaceTable(string $stub, string $table): string
    {
        return str_replace('%TABLE%', $table, $stub);
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        return BASE_PATH . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass(string $table, string $name, string $primaryKey, ModelOption $option): string
    {
        $stub = file_get_contents(BASE_PATH . '/app/Component/Generate/Model/stubs/Model.stub');

        return $this->replaceNamespace($stub, $name)
            ->replaceInheritance($stub, $option->getInheritance())
            ->replaceConnection($stub, $option->getPool())
            ->replaceUses($stub, $option->getUses())
            ->replaceClass($stub, $name)
            ->replacePrimaryKey($stub, $primaryKey)
            ->replaceTable($stub, $table);
    }

    protected function getColumns($className, $columns, $forceCasts): array
    {
        /** @var Model $model */
        $model = new $className();
        $dates = $model->getDates();
        $casts = [];
        if (!$forceCasts) {
            $casts = $model->getCasts();
        }

        foreach ($dates as $date) {
            if (!isset($casts[$date])) {
                $casts[$date] = 'datetime';
            }
        }

        foreach ($columns as $key => $value) {
            $columns[$key]['cast'] = $casts[$value['column_name']] ?? null;
        }

        return $columns;
    }

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

        if (!file_exists($path)) {
            $this->mkdir($path);
            file_put_contents($path, $this->buildClass($table, $class, $this->getPrimaryKey($columns), $option));
        }

        $columns = $this->getColumns($class, $columns, $option->isForceCasts());

        $stms = $this->astParser->parse(file_get_contents($path));
        $traverser = new NodeTraverser();
        $traverser->addVisitor(make(ModelUpdateVisitor::class, [
            'class'   => $class,
            'columns' => $columns,
            'option'  => $option,
        ]));
        $traverser->addVisitor(make(ModelRewriteConnectionVisitor::class, [$class, $option->getPool()]));
        $data = make(ModelData::class)->setClass($class)->setColumns($columns);
        foreach ($option->getVisitors() as $visitorClass) {
            $traverser->addVisitor(make($visitorClass, [$option, $data]));
        }
        $stms = $traverser->traverse($stms);
        $code = $this->printer->prettyPrintFile($stms);

        file_put_contents($path, $code);

        if ($option->isWithIde()) {
            $this->generateIDE($code, $option, $data);
        }
    }

    protected function generateIDE(string $code, ModelOption $option, ModelData $data)
    {
        $stms = $this->astParser->parse($code);
        $traverser = new NodeTraverser();
        $traverser->addVisitor(make(GenerateModelIDEVisitor::class, [$option, $data]));
        $stms = $traverser->traverse($stms);
        $code = $this->printer->prettyPrintFile($stms);
        $class = str_replace('\\', '_', $data->getClass());
        $path = BASE_PATH . '/runtime/ide/' . $class . '.php';
        $this->mkdir($path);
        file_put_contents($path, $code);
    }

    protected function isIgnoreTable(string $table, ModelOption $option): bool
    {
        if (in_array($table, $option->getIgnoreTables())) {
            return true;
        }

        return $table === $this->config->get('databases.migrations', 'migrations');
    }

    protected function createModels(ModelOption $option)
    {
        $builder = $this->getSchemaBuilder($option->getPool());
        $tables = [];

        foreach ($builder->getAllTables() as $row) {
            $row = (array)$row;
            $table = reset($row);
            if (!$this->isIgnoreTable($table, $option)) {
                $tables[] = $table;
            }
        }

        foreach ($tables as $table) {
            $this->createModel($table, $option);
        }
    }

    protected function getOption(string $key, string $pool = 'default', $default = null)
    {
        return $this->config->get("databases.{$pool}.{$key}", $default);
    }

    public function create(string $table = '', string $pool = 'default'): bool
    {
        $option = new ModelOption();
        $option->setPool($pool)
            ->setPath($this->getOption('commands.gen:model.path', $pool, 'app/Model'))
            ->setPrefix($this->getOption('prefix', $pool, ''))
            ->setInheritance($this->getOption('commands.gen:model.inheritance', $pool, 'Model'))
            ->setUses($this->getOption('commands.gen:model.uses', $pool, 'Hyperf\DbConnection\Model\Model'))
            ->setForceCasts($this->getOption('commands.gen:model.force_casts', $pool, false))
            ->setRefreshFillable($this->getOption('commands.gen:model.refresh_fillable', $pool, false))
            ->setTableMapping($this->getOption('commands.gen:model.table_mapping', $pool, []))
            ->setIgnoreTables($this->getOption('commands.gen:model.ignore_tables', $pool, []))
            ->setWithComments($this->getOption('commands.gen:model.with_comments', $pool, false))
            ->setWithIde($this->getOption('commands.gen:model.with_ide', $pool, false))
            ->setVisitors($this->getOption('commands.gen:model.visitors', $pool, []))
            ->setPropertyCase($this->getOption('commands.gen:model.property_case', $pool));

        if ($table) {
            $this->createModel($table, $option);
        } else {
            $this->createModels($option);
        }

        return true;
    }
}
