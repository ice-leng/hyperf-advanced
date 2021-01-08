<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // admin
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('account', 32)->comment('账号');
            $table->string('password', 255)->comment('密码');
            $table->string('role', 255)->comment('角色');
            $table->string('nickname', 32)->comment('昵称');
            $table->unsignedInteger('number')->default(1)->comment('工号');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态，1正常2冻结');
            $table->unsignedTinyInteger('enable')->comment('状态');
            $table->unsignedInteger('create_at');
            $table->unsignedInteger('update_at');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
}
