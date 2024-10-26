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
            $table->string('nombre_requerimientos')->nullable();
            $table->date('f_presentacion_req_inicio')->nullable();
            $table->date('f_presentacion_req_fin')->nullable();
            $table->integer('presentacion_dias')->nullable()->default(0);
            //Designacion de Cotizador
            $table->string('nombre_cotizador')->nullable();
            $table->date('f_designacion_cotizador_inicio')->nullable();
            $table->date('f_designacion_cotizador_fin')->nullable();
            $table->integer('designacion_dias')->nullable()->default(0);
            //Estudio de Mercado
            $table->date('f_estudio_mercado_inicio')->nullable();
            $table->date('f_estudio_mercado_fin')->nullable();
            $table->integer('estudiomercado_dias')->nullable()->default(0);
            //Cuadro Comparativo
            $table->string('nombre_cuadro_comparativo')->nullable();
            $table->date('f_cuadro_comparativo_inicio')->nullable();
            $table->date('f_cuadro_comparativo_fin')->nullable();
            $table->integer('cuadro_comparativo_dias')->nullable()->default(0);
            //numero de certificacion//
            $table->integer('numero_certificacion')->nullable()->default(0);
            $table->date('f_numero_certificacion_inicio')->nullable();
            $table->date('f_numero_certificacion_fin')->nullable();
            $table->integer('numero_certificacion_dias')->nullable()->default(0);
            //Orden de Servicio
            $table->integer('numero_orden')->nullable()->default(0);
            $table->date('f_orden_servicio_inicio')->nullable();
            $table->date('f_orden_servicio_fin')->nullable();
            $table->integer('orden_servicio_dias')->nullable()->default(0);
            //Notificacion
            $table->string('email_presencial')->nullable();
            $table->date('f_notificacion_inicio')->nullable();
            $table->date('f_notificacion_fin')->nullable();
            $table->integer('notificacion_dias')->nullable()->default(0);

            // Plazo de ejecución
            $table->integer('plazo_ejecucion_dias')->nullable()->default(0);
            $table->date('fecha_plazo_ejecucion')->nullable();

            // Ampliacion de plazo
            $table->integer('ampliacion_plazo_dias')->nullable()->default(0);
            $table->date('fecha_ampliacion_plazo')->nullable();

            // Observaciones
            $table->string('observaciones', 1024)->nullable();

            //Carta de Desestimiento
            $table->date('fecha_carta_desestimiento')->nullable();

            //Entregable Producto
            $table->date('f_entrega_producto')->nullable();

            //Retorno a SGEP
            //$table->date('f_retorno_SGEP_inicio')->nullable();
            //$table->date('f_retorno_SGEP_fin')->nullable();
            //$table->integer('retorno_SGEP_dias')->nullable()->default(0);

            //Deriva a proyectista
            $table->date('fecha_derivar_proyectista')->nullable();

            //Informe de Conformidad
            $table->date('fecha_informe_conformidad')->nullable();

            //Deriva a la SGEP(administracion)
            $table->date('fecha_SGEP_administracion')->nullable();

            //Conformidad
            $table->string('conformidad')->nullable();

            //Envio a SGASA Penalidad
            $table->date('fecha_SGASA_penalidad')->nullable();
            $table->string('envio')->nullable();
            $table->integer('penalidad_dias')->nullable()->default(0);

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
