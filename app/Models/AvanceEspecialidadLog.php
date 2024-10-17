<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceEspecialidadLog extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'avance_especialidad_log';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'avanceEspecialidadValor',
        'fechaCambioAvanceEspecialidad',
        'idEspecialidad',
    ];

    // Define la relación con el modelo Subfase
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'idEspecialidad', 'idEspecialidad');
    }
}