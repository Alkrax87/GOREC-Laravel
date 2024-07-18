<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceLog extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'avance_log';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'avanceSubfaseOLD',
        'avanceSubfaseNEW',
        'fechaCambioAvance',
        'idSubfase'
    ];

    // Define la relación con el modelo Subfase
    public function subfase()
    {
        return $this->belongsTo(Subfase::class, 'idSubfase', 'idSubfase');
    }
}