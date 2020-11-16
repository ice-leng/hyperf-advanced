<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $parent 
 * @property string $child 
 */
class AuthItemChild extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_item_child';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent', 'child'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}