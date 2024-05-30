<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fase', function (Blueprint $table) {
            $table->id('idFase')->primary();
            $table->string('nombreFase');
            $table->integer('porcentajeFase');
            $table->unsignedBigInteger('idEspecialidad');
            $table->foreign('idEspecialidad')->references('idEspecialidad')->on('especialidad')->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fase');
    }
};
