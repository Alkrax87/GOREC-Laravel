<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inversion', function (Blueprint $table) {
            $table->unsignedBigInteger('idCordinador')->nullable()->after('idUsuario');
            $table->foreign('idCordinador')->references('idUsuario')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('inversion', function (Blueprint $table) {
            $table->dropForeign(['idCordinador']);
            $table->dropColumn('idCordinador');
        });
    }
};
