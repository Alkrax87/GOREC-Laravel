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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUser')->primary();
            $table->string('nombreUsuarios');
            $table->string('apellidoUsuarios');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profesionUsuarios')->nullable();
            $table->string('especialidadUsuarios')->nullable();
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('usuarios');
    }
};

