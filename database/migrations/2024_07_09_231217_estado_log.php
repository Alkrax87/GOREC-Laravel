<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('estado_log', function (Blueprint $table) {
            $table->string('estadoInversionOLD');
            $table->string('estadoInversionNEW');
            $table->date('fechaCambioEstado');
            $table->unsignedBigInteger('idInversion');
            $table->foreign('idInversion')->references('idInversion')->on('inversion')->onDelete('cascade')->onUpdate('cascade');;
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estado_log');
    }
};
