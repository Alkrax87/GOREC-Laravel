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
    
    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'idInversion');
    }
}



class Fase extends Model
{
    protected $fillable = ['nombreFase', 'porcentajeFase', 'idEspecialidad'];

    public function subfases()
    {
        return $this->hasMany(Subfase::class, 'idFase');
    }
}

class Subfase extends Model
{
    protected $fillable = ['nombreSubfase', 'fechaInicioSubfase', 'fechaFinalSubfase', 'idFase'];

}
