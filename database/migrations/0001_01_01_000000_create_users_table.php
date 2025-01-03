<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUsuario')->primary();
            $table->string('nombreUsuario');
            $table->string('apellidoUsuario');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->boolean('isAdministrativo')->default(false);
            $table->string('categoriaUsuario')->nullable();
            $table->boolean('password_changed')->default(false);
            $table->string('ObservacionUser', 1024)->nullable();
            $table->timestamps(false);
        });

        DB::table('users')->insert([
            'nombreUsuario' => 'Admin',
            'apellidoUsuario' => 'Gorec',
            'email' => 'admin@gorec.com',
            'password' => bcrypt('admin123'),
            'isAdmin' => true,
            'categoriaUsuario' => null,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
    
};