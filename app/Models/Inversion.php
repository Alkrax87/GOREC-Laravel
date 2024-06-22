<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'inversion';

    // Define la clave primaria
    protected $primaryKey = 'idInversion';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'cuiInversion',
        'nombreInversion',
        'nombreCortoInversion',
        'nivelInversion',
        'provinciaInversion',
        'distritoInversion',
        'funcionInversion',
        'presupuestoFormulacionInversion',
        'presupuestoEjecucionfuncionInversion',
        'modalidadEjecucionInversion',
        'estadoInversion',
        'fechaInicioInversion',
        'fechaFinalInversion',
    ];

    // Define la relación inversa con el modelo Segmento
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idInversion', 'idInversion');
    }

    // Define la relación inversa con el modelo AsignacionProfesional
    public function profesional()
    {
        return $this->hasMany(AsignacionProfesional::class, 'idInversion', 'idInversion');
    }

    // Define la relación inversa con el modelo AsignacionAsistente
    public function asistente()
    {
        return $this->hasMany(AsignacionAsistente::class, 'idInversion', 'idInversion');
    }

    // Define la relación inversa con el modelo Especialidad
    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'idInversion');
    }

    // Define la relación inversa con el modelo Estudios Complementarios
    public function  complementario()
    {
        return $this->hasMany(Complementario::class, 'idInversion');
    }
}