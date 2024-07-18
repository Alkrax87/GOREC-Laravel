<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'especialidad';

    // Define la clave primaria
    protected $primaryKey = 'idEspecialidad';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'nombreEspecialidad',
        'porcentajeAvanceEspecialidad',
        'avanceTotalEspecialidad',
        'idInversion',
        'idUsuario',
    ];

    // Define la relación con el modelo Inversion
    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'idInversion');
    }

    // Define la relación con el modelo Fase
    public function fases()
    {
        return $this->hasMany(Fase::class, 'idEspecialidad');
    }

    // Define la relación con el modelo EspecialidadUsers
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'especialidad_users', 'idEspecialidad', 'idUsuario');
    }
}