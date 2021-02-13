<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $item_name 
 * @property string $user_id 
 * @property int $created_at 
 */
class AuthAssignment extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_assignment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_name', 'user_id', 'created_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'integer'];
}