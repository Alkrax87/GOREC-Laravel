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
        Schema::create('inversion', function (Blueprint $table) {
            $table->id('idInversion')->primary();
            $table->string('cuiInversion');
            $table->string('nombreInversion');
            $table->string('nombreCortoInversion');
            $table->string('nivelInversion');
            $table->string('provinciaInversion');
            $table->string('distritoInversion');
            $table->string('funcionInversion');

            $table->string('presupuestoFormulacionInversion');
            $table->string('presupuestoEjecucionfuncionInversion');
            $table->string('modalidadEjecucionInversion');
            $table->string('estadoInversion');

            $table->date('fechaInicioInversion');
            $table->date('fechaFinalInversion');
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('inversion');
    }
};
