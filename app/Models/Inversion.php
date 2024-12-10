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
        'idUsuario',
        'idCordinador',
        'provinciaInversion',
        'distritoInversion',
        'nivelInversion',
        'funcionInversion',
        'modalidadInversion',
        'estadoInversion',
        'avanceInversion',
        'fechaInicioInversion',
        'fechaFinalInversion',
        'presupuestoFormulacionInversion',
        'presupuestoEjecucionInversion',
        'fechaInicioConsistenciaInversion',
        'fechaFinalConsistenciaInversion',
        'Fecha_ConformidadTecnica_Inversion',
        'ConformidadTecnica',
        'fecha_ActoResolutivo_Inversion',
        'ActoResolutivo_URL',
        'archivoInversion',
    ];

    // Define la relación con el modelo User
    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    // Define la relación con el modelo User
    public function cordinador(){
        return $this->belongsTo(User::class, 'idCordinador', 'idUsuario');
    }

    // Define la relación con el modelo Segmento
    public function segmentos(){
        return $this->hasMany(Segmento::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo EstadoLog
    public function estado_log(){
        return $this->hasMany(EstadoLog::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo AvanceInversionLog
    public function avance_inversion_log(){
        return $this->hasMany(AvanceInversionLog::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo AsignacionProfesional
    public function profesional(){
        return $this->hasMany(AsignacionProfesional::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo AsignacionAsistente
    public function asistente(){
        return $this->hasMany(AsignacionAsistente::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo Complementario
    public function complementario(){
        return $this->hasMany(Complementario::class, 'idInversion');
    }

    // Define la relación con el modelo Especialidad
    public function especialidades(){
        return $this->hasMany(Especialidad::class, 'idInversion');
    }
}