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
        Schema::create('xapp1s1shops', function (Blueprint $table) {
//            $table->id();
            $table->bigInteger('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            // 图片分为 菜品 环境 菜单 资质 其他

            $table->string('name', 30)->nullable(); // 商铺名称
            $table->time('starttime')->nullable(); // 开始营业时间
            $table->time('endtime')->nullable(); // 结束营业时间
            $table->string('status')->nullable(); // 商铺状态
            $table->string('phone')->nullable(); // 联系电话
            $table->string('tel')->nullable(); // 座机电话
            $table->string('addr')->nullable(); // 商业地址
            $table->double('longitude', 11, 8)->nullable(); // 商业地址
            $table->double('latitude', 11, 8)->nullable(); // 商业地址

            $table->string('approval')->nullable(); // 批准状态

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
        Schema::dropIfExists('xapp1s1shops');
    }
};
