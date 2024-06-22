<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    protected $fillable = [
        'porcentajeEspecialidad',
        'idInversion'
    ];

    // Relación con Proyecto
    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'idInversion');
    }

    // Relación con Fase
    public function fases()
    {
        return $this->hasMany(Fase::class, 'idEspecialidad');
    }
}
