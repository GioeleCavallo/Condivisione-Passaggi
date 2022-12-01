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
        Schema::create('tappa_tragitto', function (Blueprint $table) {
            $table->string('tappa_luogo');  
            $table->foreignId('tragitto_id'); 
            $table->dateTime('data_orario'); 
            $table->foreign('tappa_luogo')->references('luogo')->on('tappa');
            $table->foreign('tragitto_id')->references('id')->on('tragitto');
            $table->primary(['tappa_luogo', 'tragitto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tappa_tragitto');
    }
};
