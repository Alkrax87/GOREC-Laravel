<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('inversion')->whereNotNull('idCordinador')->get()->each(function ($inversion) {
            DB::table('inversion_coordinador')->insert([
                'idInversion' => $inversion->idInversion,
                'idUsuario' => $inversion->idCordinador
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('new', function (Blueprint $table) {
            DB::table('inversion_coordinador')->truncate();
        });
    }
};
