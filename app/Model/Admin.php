<?php

declare (strict_types=1);
namespace App\Model;

use Lengbin\Hyperf\Common\Framework\BaseModel;
/**
 * @property string $admin_id 
 * @property string $account 账号
 * @property string $password 密码
 * @property string $role 角色
 * @property string $nickname 昵称
 * @property int $number 工号
 * @property int $status 状态
 * @property int $enable 状态
 * @property int $create_at 
 * @property int $update_at 
 */
class Admin extends BaseModel
{
    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'admin_id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_id', 'account', 'password', 'role', 'nickname', 'number', 'status', 'enable', 'create_at', 'update_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['admin_id' => 'string', 'number' => 'integer', 'status' => 'integer', 'enable' => 'integer', 'create_at' => 'datetime', 'update_at' => 'datetime'];
}