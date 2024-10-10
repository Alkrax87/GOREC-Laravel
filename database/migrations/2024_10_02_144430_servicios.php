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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id('idServicio')->primary();
            $table->string('nombre_servicio');
            $table->string('meta');
            $table->string('siaf')->nullable();

            // Campos de las fechas
            //Presentacion de requerimientos
            $table->date('f_presentacion_req_inicio');
            $table->date('f_presentacion_req_fin');
            $table->integer('presentacion_dias')->default(0);
            //Designacion de Cotizador
            $table->date('f_designacion_cotizador_inicio');
            $table->date('f_designacion_cotizador_fin');
            $table->integer('designacion_dias')->default(0);
            //Estudio de Mercado
            $table->date('f_estudio_mercado_inicio');
            $table->date('f_estudio_mercado_fin');
            $table->integer('estudiomercado_dias')->default(0);
            //Cuadro Comparativo
            $table->date('f_cuadro_comparativo_inicio');
            $table->date('f_cuadro_comparativo_fin');
            $table->integer('cuadro_comparativo_dias')->default(0);
            //Elaboracion de Certificado
            $table->date('f_elaboracion_certificado_inicio');
            $table->date('f_elaboracion_certificado_fin');
            $table->integer('elaboracion_certificado_dias')->default(0);
            //Orden de Servicio
            $table->date('f_orden_servicio_inicio');
            $table->date('f_orden_servicio_fin');
            $table->integer('orden_servicio_dias')->default(0);
            //Notificacion
            $table->date('f_notificacion_inicio');
            $table->date('f_notificacion_fin');
            $table->integer('notificacion_dias')->default(0);

            // Plazo de ejecución
            $table->integer('plazo_ejecucion_dias')->default(0);
            $table->date('fecha_plazo_ejecucion');

            // Ampliacion de plazo
            $table->integer('ampliacion_plazo_dias')->nullable()->default(0);
            $table->date('fecha_ampliacion_plazo')->nullable();

            // Observaciones
            $table->text('observaciones')->nullable();

            //Carta de Desestimiento
            $table->date('fecha_carta_desestimiento')->nullable();

            //Entregable Mesa de Partes
            $table->date('f_mesa_partes_inicio');

            //Retorno a SGEP
            $table->date('f_retorno_SGEP_inicio');
            $table->date('f_retorno_SGEP_fin');
            $table->integer('retorno_SGEP_dias')->default(0);

            //Deriva a proyectista
            $table->date('fecha_derivar_proyectista');

            //Informe de Conformidad
            $table->date('fecha_informe_conformidad');

            //Deriva a la SGEP(administracion)
            $table->date('fecha_SGEP_administracion');

            //Conformidad
            $table->string('conformidad')->nullable();

            //Envio a SGASA Penalidad
            $table->date('fecha_SGASA_penalidad')->nullable();
            $table->string('envio')->nullable();

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
        Schema::dropIfExists('servicios');
    }
};
