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
        Schema::create('auto', function (Blueprint $table) {
            //$table->id();
            $table->string('targa')->primary();
            $table->string('marca');
            $table->string('colore');
            $table->integer('posti');
            $table->foreignId('auto_user');
            $table->foreign('auto_user')->references('id')->on('users'); // o email
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto');
    }
};
