<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subfase', function (Blueprint $table) {
            $table->id('idSubfase')->primary();
            $table->string('nombreSubfase');
            $table->date('fechaInicioSubfase');
            $table->date('fechaFinalSubfase');
            $table->integer('cantidadDiasSubFase')->default(0);
            $table->decimal('porcentajeAvanceProgramadoSubFase', 15, 2)->default(0);
            $table->integer('avance_por_usuario_realSubFase')->default(0);
            $table->decimal('avanceRealTotalSubFase', 15, 2)->default(0);
            $table->unsignedBigInteger('idFase');
            $table->foreign('idFase')->references('idFase')->on('fase')->onDelete('cascade');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subfase');
    }
};