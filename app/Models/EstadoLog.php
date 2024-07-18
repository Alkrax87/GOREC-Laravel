<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoLog extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'estado_log';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'estadoInversionOLD',
        'estadoInversionNEW',
        'fechaCambioEstado',
        'idInversion'
    ];

    // Define la relación con el modelo Inversion
    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'idInversion', 'idInversion');
    }
}