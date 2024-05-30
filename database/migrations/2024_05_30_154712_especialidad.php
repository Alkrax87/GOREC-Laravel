<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especialidad', function (Blueprint $table) {
            $table->id('idEspecialidad')->primary();
            $table->integer('porcentajeEspecialidad');
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especialidad');
    }
};
