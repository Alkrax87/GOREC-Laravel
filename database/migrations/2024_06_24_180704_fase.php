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
        Schema::create('fase', function (Blueprint $table) {
        $table->id('idFase')->primary();
        $table->string('nombreFase');
        $table->decimal('porcentajeAvanceFase',15, 2);
        $table->decimal('avanceTotalFase', 15, 2);
        $table->unsignedBigInteger('idEspecialidad');
        $table->foreign('idEspecialidad')->references('idEspecialidad')->on('especialidad')->onDelete('cascade');
        $table->timestamps(false);
        });
    }
    public function down(): void
    {
    Schema::dropIfExists('fase');
    }
};
