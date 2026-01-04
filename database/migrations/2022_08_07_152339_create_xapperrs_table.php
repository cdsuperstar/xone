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
        Schema::create('xapperrs', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable(); // Message
            $table->text('stack')->nullable(); // Stack
            $table->string('info')->nullable(); // Info
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
        Schema::dropIfExists('xapperrs');
    }
};
