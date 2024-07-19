<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especialidad_users', function (Blueprint $table) {
            $table->unsignedBigInteger('idEspecialidad');
            $table->foreign('idEspecialidad')->references('idEspecialidad')->on('especialidad')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especialidad_users');
    }
};