<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inversion', function (Blueprint $table) {
            $table->id('idInversion')->primary();
            $table->string('cuiInversion');
            $table->string('nombreInversion');
            $table->string('nombreCortoInversion');
            $table->string('nivelInversion');
            $table->string('provinciaInversion');
            $table->string('distritoInversion');
            $table->string('funcionInversion');
            $table->decimal('presupuestoFormulacionInversion', 15, 2);
            $table->decimal('presupuestoEjecucionfuncionInversion', 15, 2);
            $table->string('modalidadEjecucionInversion');
            $table->string('estadoInversion');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fechaModificacionEstadoInversion')->nullable();
            $table->string('avanceTotalInversion')->nullable();
            $table->date('fechaInicioInversion');
            $table->date('fechaFinalInversion');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inversion');
    }
};
