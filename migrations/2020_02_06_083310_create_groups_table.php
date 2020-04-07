<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20)->comment('组名称')->default('');
            $table->string('desc', 100)->comment('组描述')->default('');
            $table->text('rules')->nullable($value = true)->comment('组所拥有权限,以,隔开');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE `groups` comment '管理组表'");//表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
