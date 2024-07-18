<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudios_complementarios', function (Blueprint $table) {
            $table->id('idEstudiosComplementarios')->primary();
            $table->string('nombreEstudiosComplementarios');
            $table->string('observacionEstudiosComplementarios');
            $table->date('fechaInicioEstudiosComplementarios');
            $table->date('fechaFinalEstudiosComplementarios');
            $table->string('estadoEstudiosComplementarios');
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudios_complementarios');
    }
};