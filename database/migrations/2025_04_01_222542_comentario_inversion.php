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
        Schema::create('comentario_inversion', function (Blueprint $table) {
            $table->id('idComentarioInversion')->primary();
            $table->string('asuntoComentarioInversion');
            $table->string('comentariosInversion');
            $table->date('fechaComentarioInversion');
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_inversion');
    }
};
