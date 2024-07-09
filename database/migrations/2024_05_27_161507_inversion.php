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
            $table->string('nombreInversion', 1024);
            $table->string('nombreCortoInversion');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('provinciaInversion');
            $table->string('distritoInversion');
            $table->string('nivelInversion');
            $table->string('funcionInversion');
            $table->string('modalidadInversion');
            $table->string('estadoInversion');
            $table->unsignedTinyInteger('avanceInversion')->default(0);
            $table->date('fechaInicioInversion');
            $table->date('fechaFinalInversion');
            $table->decimal('presupuestoFormulacionInversion', 23, 2);
            $table->decimal('presupuestoEjecucionInversion', 23, 2);
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inversion');
    }
};