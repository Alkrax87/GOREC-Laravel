<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
     
    protected $table = 'fase';

    protected $primaryKey = 'idFase';

    public $timestamps = false;

    protected $fillable = [
        'nombreFase',
        'porcentajeAvanceFase',
        'avanceTotalFase',
        'idEspecialidad',
    ];
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'idEspecialidad');
    }
    public function subfases()
    {
        return $this->hasMany(SubFase::class, 'idFase');
    }
}
