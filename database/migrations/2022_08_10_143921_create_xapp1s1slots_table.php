<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->decimal('price', 7, 2)->nullable(); // 金额
            $table->text('note')->nullable(); // 备注

            // 匹配条件
            $table->integer('agebegin')->nullable(); // S
            $table->integer('ageend')->nullable(); // S
            $table->string('constellation')->default("不限")->nullable(); // S
            //0 - 未知的性别
            //1 - 男性
            //2 - 女性
            //9 - 未说明的性别
            $table->string('sex', 1)->default("0")->nullable();//性别 S

            $table->integer('heightbegin')->nullable();//身高 S
            $table->integer('heightend')->nullable();//身高 S
            $table->integer('incomebegin')->nullable();//收入开始 S
            $table->integer('incomeend')->nullable();//收入结束 S
            $table->string('eduback')->default("不限")->nullable();//学历 S
            $table->string('marriage')->default("不限")->nullable();//婚姻状况 S
            $table->string('career')->default("不限")->nullable();//职业 S
            $table->integer('weightbegin')->nullable();//体重 S
            $table->integer('weightend')->nullable();//体重 S
            $table->string('housesitu')->default("不限")->nullable();//购房情况 S
            $table->string('carsitu')->default("不限")->nullable();//购车情况 S
            $table->string('smokesitu')->default("不限")->nullable();//吸烟情况 S
            $table->string('drinksitu')->default("不限")->nullable();//喝酒情况 S
            $table->string('childrensitu')->default("不限")->nullable();//小孩情况 S

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
