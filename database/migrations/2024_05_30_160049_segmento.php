<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('segmento', function (Blueprint $table) {
            $table->id('idSegmento')->primary();
            $table->string('nombreSegmento');
            $table->date('fechaInicioSegmento');
            $table->date('fechaFinalSegmento');
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('restrict');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segmento');
    }
};
