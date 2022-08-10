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
        Schema::create('xapp1s1activates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('xapp1s1shop_id')->nullable();
            $table->string('name')->nullable(); // 活动名称
            $table->text('description')->nullable(); // 介绍及流程
            $table->decimal('tagprice', 7, 2)->nullable(); // 标价
            $table->decimal('price', 7, 2)->nullable(); // 价格
            $table->datetime('timebegin',)->nullable(); // 开始时间
            $table->datetime('timeend')->nullable(); // 结束时间
            $table->string('address')->nullable(); // 地点

            $table->integer('slot')->nullable(); // 人数

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
        Schema::dropIfExists('xapp1s1activates');
    }
};
