<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('is_super')->index()->comment('是否超管：0否、1是')->default(0);
            $table->string('name', 20)->index('name')->comment('用户名')->default('');
            $table->string('account',20)->default('')->unique()->comment('登陆账号');
            $table->string('password', 32)->index()->comment('登录密码')->default('');
//            $table->string('mobile', 11)->unique('mobile')->comment('电话')->default('');
            $table->unsignedTinyInteger('status')->comment('状态:1正常,2冻结')->default(1);
            $table->unsignedBigInteger('group_id')->index('group_id')->comment('管理组id')->default(0);
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE `admins` comment '管理员表'");//表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
