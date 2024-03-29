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
        Schema::create('xapp1s1moments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(); // 用户ID
            $table->text('note')->nullable(); // 动态
            $table->text('type')->default('个人'); // 类型
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
        Schema::dropIfExists('xapp1s1moments');
    }
};
