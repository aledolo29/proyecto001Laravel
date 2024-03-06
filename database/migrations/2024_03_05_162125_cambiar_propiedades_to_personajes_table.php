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
        Schema::table('personajes', function (Blueprint $table) {
            $table->string('apariencia')->nullable()->change();
            $table->string('historia')->nullable()->change();
            $table->string('afilicion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personajes', function (Blueprint $table) {
            //
        });
    }
};
