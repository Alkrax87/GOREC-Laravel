<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'segmento';

    // Define la clave primaria
    protected $primaryKey = 'idSegmento';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'nombreSegmento',
        'fechaInicioSegmento',
        'fechaFinalSegmento',
        'idInversion',
        'idUsuario'
    ];

    // Define la relación con el modelo Inversion
    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'idInversion', 'idInversion');
    }

    // Define la relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
}