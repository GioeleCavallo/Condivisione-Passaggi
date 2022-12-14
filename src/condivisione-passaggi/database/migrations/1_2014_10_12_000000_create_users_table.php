<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_tipo');
            $table->foreign('user_tipo')->references('nome')->on('tipo');
            $table->rememberToken();
            $table->timestamps();
        });
        $items = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.ch',
                'password' => Hash::make('admin'),
                'user_tipo' => 'admin'
            ]
        ];

        DB::table("users")->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
