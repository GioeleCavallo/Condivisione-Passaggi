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
        Schema::create('giorno_tragitto', function (Blueprint $table) {
            $table->string('giorno_nome');
            $table->foreignId('tragitto_id');
            $table->foreign('giorno_nome')->references('nome')->on('giorno');
            $table->foreign('tragitto_id')->references('id')->on('tragitto');
            $table->primary(['giorno_nome', 'tragitto_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giorno_tragitto');
    }
};
