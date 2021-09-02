<?php
/**
 * Created by PhpStorm.
 * Date:  2021/9/2
 * Time:  2:36 下午
 */

declare(strict_types=1);

namespace App\Kernel\Commands\Model;

use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\PropertyProperty;

class ModelUpdateVisitor extends \Hyperf\Database\Commands\Ast\ModelUpdateVisitor
{
    protected function rewriteFillable(PropertyProperty $node): PropertyProperty
    {
        $items = [];
        $exceptColumn = [
            'create_at',
            'update_at',
            'enable',
        ];
        foreach ($this->columns as $column) {
            if ($column['column_key'] === 'PRI' || in_array($column['column_name'], $exceptColumn)) {
                continue;
            }
            $items[] = new Node\Expr\ArrayItem(new String_($column['column_name']));
        }
        $node->default = new Array_($items, [
            'kind' => Array_::KIND_SHORT,
        ]);
        return $node;
    }

    protected function formatDatabaseType(string $type): ?string
    {
        switch ($type) {
            case 'tinyint':
            case 'smallint':
            case 'mediumint':
            case 'int':
                return 'integer';
            case 'bigint':
            case 'decimal':
            case 'float':
            case 'double':
            case 'real':
                return 'string';
            case 'bool':
            case 'boolean':
                return 'boolean';
            default:
                return null;
        }
    }
}
