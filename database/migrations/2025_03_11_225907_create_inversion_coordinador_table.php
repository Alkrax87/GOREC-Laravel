<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inversion_coordinador', function (Blueprint $table) {
            $table->unsignedBigInteger('idInversion');
            $table->unsignedBigInteger('idUsuario');
            $table->timestamps(false);

            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inversion_coordinador');
    }
};
