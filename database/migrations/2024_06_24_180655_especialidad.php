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
        Schema::create('especialidad', function (Blueprint $table) {
            $table->id('idEspecialidad')->primary();
            $table->string('nombreEspecialidad');
            $table->decimal('porcentajeAvanceEspecialidad',15, 2);
            $table->decimal('avanceTotalEspecialidad', 15, 2);
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especialidad');
    }
};
