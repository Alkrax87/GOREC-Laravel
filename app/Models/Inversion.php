<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    protected $table = 'inversion';

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
    
    protected $primaryKey = 'idInversion';
}
