<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $name 
 * @property string $type 
 * @property string $description 
 * @property string $rule_name 
 * @property int $created_at 
 * @property int $updated_at 
 */
class AuthItem extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_item';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'description', 'rule_name', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'integer', 'updated_at' => 'integer'];
}