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
        Schema::create('utente_tragitto', function (Blueprint $table) {
            $table->foreignId('utente_id');  
            $table->foreignId('tragitto_id');  

            $table->foreign('utente_id')->references('id')->on('users');
            $table->foreign('tragitto_id')->references('id')->on('tragitto');
            
            $table->boolean('accettato');

            $table->primary(['utente_id', 'tragitto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utente_tragitto');
    }
};
