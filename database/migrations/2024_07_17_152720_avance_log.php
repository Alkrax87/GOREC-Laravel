<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avance_log', function (Blueprint $table) {
            $table->string('avanceSubfaseOLD');
            $table->string('avanceSubfaseNEW');
            $table->datetime('fechaCambioAvance');
            $table->unsignedBigInteger('idSubfase');
            $table->foreign('idSubfase')->references('idSubfase')->on('subfase')->onDelete('cascade')->onUpdate('cascade');;
            $table->timestamps(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avance_log');
    }
};