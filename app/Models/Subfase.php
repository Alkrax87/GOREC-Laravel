<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFase extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'subfase';

    // Define la clave primaria
    protected $primaryKey = 'idSubfase';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
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

    // Define la relación con el modelo Fase
    public function fase()
    {
        return $this->belongsTo(Fase::class, 'idFase');
    }

    // Define la relación con el modelo AvanceLog
    public function estado_log(){
        return $this->hasMany(AvanceLog::class, 'idSubfase', 'idSubfase');
    }
}