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
        Schema::create('xapp1s1products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable; // 名称
            $table->decimal('tagprice', 7, 2)->nullable(); // 标价
            $table->decimal('price', 7, 2)->nullable(); // 价格
            $table->dateTime('timebegin')->nullable(); //可用时间开始
            $table->dateTime('timeend')->nullable(); //可用时间结束
            $table->text('note')->nullable(); // 须知

            $table->unsignedBigInteger('xapp1s1shop_id')->nullable(); //
//            $table->foreign('xapp1s1shop_id')->references('id')->on('xapp1s1shops')->onDelete('cascade');
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
        Schema::dropIfExists('xapp1s1products');
    }
};
