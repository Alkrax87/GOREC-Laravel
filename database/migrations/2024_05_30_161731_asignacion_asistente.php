<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignacion_asistente', function (Blueprint $table) {
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idAsistente');
            $table->foreign('idAsistente')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idJefe');
            $table->foreign('idJefe')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignacion_asistente');
    }
};
