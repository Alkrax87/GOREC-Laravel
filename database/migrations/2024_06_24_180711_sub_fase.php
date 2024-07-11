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
        Schema::create('subfase', function (Blueprint $table) {
            $table->id('idSubfase')->primary();
            $table->string('nombreSubfase');
            $table->date('fechaInicioSubfase');
            $table->date('fechaFinalSubfase');
            $table->integer('cantidadDiasSubFase');
            $table->decimal('porcentajeAvanceProgramadoSubFase', 15, 2);
            $table->integer('avance_por_usuario_realSubFase');
            $table->decimal('avanceRealTotalSubFase', 15, 2);
            $table->unsignedBigInteger('idFase');
            $table->foreign('idFase')->references('idFase')->on('fase')->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subfase');
    }
};

