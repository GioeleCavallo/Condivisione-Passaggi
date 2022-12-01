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
        Schema::create('giorno', function (Blueprint $table) {
            $table->string('nome')->primary();
        });
        
        $items = [
            ['nome' => 'lunedì'],
            ['nome' => 'martedì'],
            ['nome' => 'mercoledì'],
            ['nome' => 'giovedì'],
            ['nome' => 'venerdì'],
            ['nome' => 'sabato'],
            ['nome' => 'domenica']
        ];

        DB::table("giorno")->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giorno');
    }
};
