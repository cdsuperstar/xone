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
        Schema::create('xapp1s1profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('realname', 30)->nullable();
            $table->string('idcard', 18)->nullable();//身份证
            $table->string('phone')->nullable();//电话号码
            $table->string('companyname')->nullable();//就职单位
            $table->string('approval')->default('待审核')->nullable();// 审核状态

            // 自动生成
            $table->date('birthday')->nullable();
            $table->string('constellation', 6)->nullable();

            $table->string('nickname', 30)->nullable();
            //0 - 未知的性别
            //1 - 男性
            //2 - 女性
            //9 - 未说明的性别
            $table->string('sex', 1)->nullable();//性别
            $table->integer('height')->nullable();//身高
            $table->integer('incomebegin')->nullable();//收入开始
            $table->integer('incomeend')->nullable();//收入结束
            $table->string('workaddress')->nullable();//工作地点
            $table->string('eduback')->nullable();//学历
            $table->string('marriage')->nullable();//婚姻状况

            $table->string('nationality')->nullable();//名族
            $table->string('career')->nullable();//职业
            $table->string('nativeplace')->nullable();//籍贯
            $table->integer('weight')->nullable();//体重
            $table->string('housesitu')->nullable();//购房情况
            $table->string('carsitu')->nullable();//购车情况

            $table->string('smokesitu')->nullable();//吸烟情况
            $table->string('drinksitu')->nullable();//喝酒情况

            $table->string('childrensitu')->nullable();//小孩情况

            $table->text('memo')->nullable();//文字简介

            $table->unique('user_id');
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
        Schema::dropIfExists('xapp1s1profiles');
    }
};
