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
        Schema::create('especialidad_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('especialidad_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps(false);
    
            $table->foreign('especialidad_id')->references('idEspecialidad')->on('especialidad')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialidad_user');
    }
};
