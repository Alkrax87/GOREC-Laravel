<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignacion_profesional', function (Blueprint $table) {
            $table->id('idAsignacionProfesional')->primary();
            $table->unsignedBigInteger('idAsignaciones');
            $table->foreign('idAsignaciones')->references('idAsignaciones')->on('asignaciones')->onDelete('restrict');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignacion_profesional');
    }
};
