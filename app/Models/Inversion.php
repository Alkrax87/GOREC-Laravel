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

    // Relación muchos a uno: Esta inversión pertenece a un usuario (responsable principal)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Esta inversión está compuesta por varios segmentos
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idInversion', 'idInversion');
    }

    // Relación uno a muchos: Esta inversión tiene un historial de estados
    public function estado_log()
    {
        return $this->hasMany(EstadoLog::class, 'idInversion', 'idInversion');
    }

    // Relación uno a muchos: Esta inversión tiene registros de avance en el tiempo
    public function avance_inversion_log()
    {
        return $this->hasMany(AvanceInversionLog::class, 'idInversion', 'idInversion');
    }

    // Relación uno a muchos: Esta inversión tiene profesionales asignados
    public function profesional()
    {
        return $this->hasMany(AsignacionProfesional::class, 'idInversion', 'idInversion');
    }

    // Relación uno a muchos: Esta inversión tiene asistentes asignados
    public function asistente()
    {
        return $this->hasMany(AsignacionAsistente::class, 'idInversion', 'idInversion');
    }

    // Relación uno a muchos: Esta inversión tiene registros complementarios asociados
    public function complementario()
    {
        return $this->hasMany(Complementario::class, 'idInversion');
    }

    // Relación uno a muchos: Esta inversión está relacionada con varias especialidades
    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'idInversion');
    }

    // Relación muchos a muchos: Esta inversión puede tener varios coordinadores asociados
    public function coordinadores()
    {
        return $this->belongsToMany(User::class, 'inversion_coordinador', 'idInversion', 'idUsuario');
    }
}