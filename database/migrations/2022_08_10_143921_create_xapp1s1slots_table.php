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
        Schema::create('xapp1s1slots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('xapp1s1activate_id')->nullable(); // 活动ID
            $table->bigInteger('user_id')->nullable(); // 用户ID
            $table->text('req')->nullable(); // 匹配条件
            $table->decimal('price', 7, 2)->nullable(); // 金额
            $table->text('note')->nullable(); // 备注

            $table->unique(['xapp1s1activate_id', 'user_id']);

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
        Schema::dropIfExists('xapp1s1slots');
    }
};
