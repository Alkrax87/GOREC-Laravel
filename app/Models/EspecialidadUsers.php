<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadUsers extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'especialidades_users';

    // Define los atributos asignables en masa
    protected $fillable = [
        'idEspecialidad',
        'idUsuario'
    ];

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define la relación con el modelo Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'idEspecialidad', 'idEspecialidad');
    }

    // Define la relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
}
