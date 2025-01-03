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

        //
        Schema::create('bienes', function (Blueprint $table) {
            $table->id('idBienes')->primary();
            $table->string('nombre_bienes');
            $table->string('meta_bienes');
            $table->string('siaf_bienes')->nullable();

            // Campos de las fechas
            //Presentacion de requerimientos
            $table->string('nombre_requerimientos_bs')->nullable();
            $table->date('f_presentacion_req_inicio_bs')->nullable();
            $table->date('f_presentacion_req_fin_bs')->nullable();
            $table->integer('presentacion_dias_bs')->nullable()->default(0);
            //Designacion de Cotizador
            $table->string('nombre_cotizador_bs')->nullable();
            $table->date('f_designacion_cotizador_inicio_bs')->nullable();
            $table->date('f_designacion_cotizador_fin_bs')->nullable();
            $table->integer('designacion_dias_bs')->nullable()->default(0);
            //Cotizacion
            $table->date('f_cotizacion_inicio_bs')->nullable();
            $table->date('f_cotizacion_fin_bs')->nullable();
            $table->integer('cotizacion_dias_bs')->nullable()->default(0);
            //Cuadro Comparativo
            $table->string('nombre_cuadro_comparativo_bs')->nullable();
            $table->date('f_cuadro_comparativo_inicio_bs')->nullable();
            $table->date('f_cuadro_comparativo_fin_bs')->nullable();
            $table->integer('cuadro_comparativo_dias_bs')->nullable()->default(0);
            //Numero de Certificacion
            $table->integer('numero_certificacion_bs')->nullable()->default(0);
            $table->date('f_numero_certificacion_inicio_bs')->nullable();
            $table->date('f_numero_certificacion_fin_bs')->nullable();
            $table->integer('numero_certificacion_dias_bs')->nullable()->default(0);
            //Numero Siaf
            //$table->date('f_numero_Siaf_inicio_bs')->nullable();
            //$table->date('f_numero_Siaf_fin_bs')->nullable();
            //$table->integer('numero_Siaf_dias_bs')->nullable()->default(0);
            //Orden de Compra
            $table->integer('numero_orden_compra_bs')->nullable()->default(0);
            $table->date('f_orden_compra_inicio_bs')->nullable();
            $table->date('f_orden_compra_fin_bs')->nullable();
            $table->integer('orden_compra_dias_bs')->nullable()->default(0);
            //Notificacion
            $table->date('f_notificacion_inicio_bs')->nullable();
            $table->date('f_notificacion_fin_bs')->nullable();
            $table->integer('notificacion_dias_bs')->nullable()->default(0);

            // Plazo de ejecución
            $table->integer('plazo_ejecucion_dias_bs')->nullable()->default(0);
            $table->date('fecha_plazo_ejecucion_bs')->nullable();

            // Ampliacion de plazo
            $table->integer('ampliacion_plazo_dias_bs')->nullable()->default(0);
            $table->date('fecha_ampliacion_plazo_bs')->nullable();

            // Observaciones
            $table->string('observaciones_bs', 1024)->nullable();

            //Carta de Desestimiento
            $table->date('fecha_carta_desestimiento_bs')->nullable();

            //Entrega Bien
            $table->date('f_entrega_bien_inicio_bs')->nullable();

            //Recepcion del bien
            $table->date('f_recepcion_bien_inicio_bs')->nullable();

            //Patrimonizacion
            $table->date('fecha_patrimonizacion_inicio_bs')->nullable();
            $table->date('fecha_patrimonizacion_fin_bs')->nullable();
            $table->integer('patrimonizacion_dias_bs')->nullable()->default(0);

            //Conformidad de Patrimonizacion
            $table->string('conformidad_patrimonizacion_bs')->nullable();

            //Informe de Conformidad(proyectista)
            $table->string('conformidad_proyectista_bs')->nullable();
            $table->date('f_conformidad_proyectista_inicio_bs')->nullable();
            $table->date('f_conformidad_proyectista_fin_bs')->nullable();
            $table->integer('conformidad_proyectista_dias_bs')->nullable()->default(0);


            //Envio a SGASA Penalidad
            $table->date('fecha_SGASA_penalidad_bs')->nullable();
            $table->string('envio_bs')->nullable();
            $table->integer('penalidad_dias_bs')->nullable()->default(0);

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
        //
        Schema::dropIfExists('bienes');
    }
};
