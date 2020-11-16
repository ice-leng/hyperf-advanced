<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $name 
 * @property string $data 
 * @property int $created_at 
 * @property int $updated_at 
 */
class AuthRule extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_rule';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'data', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'integer', 'updated_at' => 'integer'];
}