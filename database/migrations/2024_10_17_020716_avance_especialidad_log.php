<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avance_especialidad_log', function (Blueprint $table) {
            $table->unsignedTinyInteger('avanceEspecialidadValor');
            $table->datetime('fechaCambioAvanceEspecialidad');
            $table->unsignedBigInteger('idEspecialidad');
            $table->foreign('idEspecialidad')->references('idEspecialidad')->on('especialidad')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avance_especialidad_log');
    }
};