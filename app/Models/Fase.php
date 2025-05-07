<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    // Define la tabla asociada con el modelo
    protected $table = 'fase';

    // Define la clave primaria
    protected $primaryKey = 'idFase';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'nombreFase',
        'porcentajeAvanceFase',
        'avanceTotalFase',
        'idEspecialidad',
    ];

    // Define la relación con el modelo Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'idEspecialidad');
    }

    // Define la relación con el modelo SubFase
    public function subfases()
    {
        return $this->hasMany(Subfase::class, 'idFase');
    }
}