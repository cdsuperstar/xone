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
        Schema::create('z_userprofiles', function (Blueprint $table) {
//            $table->id();
            $table->bigInteger('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('no')->nullable()->unique();
            $table->string('avatar', 100)->default('/assets/default_avatar.jpg');
            $table->string('name',30)->default('Nickname');

            $table->string('sex', 1)->nullable();//性别
            $table->string('position')->nullable();//职务
            $table->string('title')->nullable();//职称
            $table->string('jobs')->nullable();//岗位
            $table->bigInteger('unitid')->nullable()->unsigned(); //部门
            $table->string('phone')->nullable();//电话号码
            $table->string('tel')->nullable();//备用电话号码
            $table->date('birth')->nullable();//生日
            $table->string('address')->nullable();//住址
            $table->text('memo')->nullable();//备注

            $table->string('companyname')->nullable();//公司名称

            $table->string('province')->nullable();//用户所在省份
            $table->string('city')->nullable();//用户所在地区、市
            $table->string('area')->nullable();//用户所在市、县

            $table->primary('id');

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
        Schema::dropIfExists('z_userprofiles');
    }
};
