<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $name 
 * @property string $pid 
 * @property string $icon 
 * @property string $path 
 * @property string $template 
 * @property string $role 
 * @property int $created_at 
 * @property int $updated_at 
 * @property int $sort 
 */
class AuthMenu extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_menu';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'pid', 'icon', 'path', 'template', 'role', 'created_at', 'updated_at', 'sort'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'integer', 'updated_at' => 'integer', 'sort' => 'integer'];
}