<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

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

    public function fases()
    {
        return $this->hasMany(Fase::class, 'idEspecialidad');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
    // app/Models/Especialidad.php
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'especialidad_user', 'especialidad_id', 'user_id');
    }

}
