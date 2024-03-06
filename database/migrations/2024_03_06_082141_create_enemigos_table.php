<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enemigos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_personaje');
            $table->unsignedBigInteger('id_enemigo');
            $table->timestamps();

            // Claves primarias compuestas
            $table->primary(['id_personaje', 'id_enemigo']);

            // Claves foráneas
            $table->foreign('id_personaje')->references('id')->on('personajes');
            $table->foreign('id_enemigo')->references('id')->on('personajes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemigos');
    }
};
