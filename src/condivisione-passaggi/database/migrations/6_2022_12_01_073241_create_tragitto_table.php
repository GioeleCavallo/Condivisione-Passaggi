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
        Schema::create('tragitto', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descrizione');
            $table->string('tragitto_auto');
            $table->foreign('tragitto_auto')->references('targa')->on('auto'); 
            $table->integer('numero_persone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tragitto');
    }
};
