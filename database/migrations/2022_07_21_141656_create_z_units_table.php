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


        Schema::create('z_units', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //单位名称
            $table->text('brief')->nullable(); //单位介绍

            $table->nestedSet();
            $table->timestamps();
        });

        // 单位 用户对应表 Luke
        Schema::create('user_z_unit', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('z_unit_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('z_unit_id')->references('id')->on('z_units')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'z_unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_z_unit');
        Schema::dropIfExists('z_units');
    }

};
