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
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUsuario')->primary();
            $table->string('nombreUsuario');
            $table->string('apellidoUsuario');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profesionUsuario')->nullable();
            $table->string('especialidadUsuario')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
