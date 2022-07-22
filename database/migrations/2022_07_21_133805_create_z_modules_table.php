<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_modules', function (Blueprint $table) {
            $table->id();
            //模块名
            $table->string('name')->unique();
            //标题
            $table->string('title');
            //TIP
            $table->string('tip')->nullable();
            //菜单类型
            $table->string('ismenu');
            //图标
            $table->string('icon')->nullable();
            //URL route
            $table->string('url')->nullable();
            //备注
            $table->string('memo')->nullable();

            //树形结构
            $table->nestedSet();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_modules');
    }
};
