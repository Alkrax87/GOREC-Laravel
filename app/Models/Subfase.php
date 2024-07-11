<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFase extends Model
{
    use HasFactory;
    
    protected $table = 'subfase';

    protected $primaryKey = 'idSubfase';

    public $timestamps = false;

    protected $fillable = [
        'nombreSubfase',
        'fechaInicioSubfase',
        'fechaFinalSubfase',
        'cantidadDiasSubFase',
        'porcentajeAvanceProgramadoSubFase',
        'avance_por_usuario_realSubFase',
        'avanceRealTotalSubFase',
        'idFase',
    ];
    public function fase()
    {
        return $this->belongsTo(Fase::class, 'idFase');
    }
}
