<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioInversion extends Model
{
    use HasFactory;
    // Define la tabla asociada con el modelo
    protected $table = 'comentario_inversion';

    // Define la clave primaria
    protected $primaryKey = 'idComentarioInversion';

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define los atributos asignables en masa
    protected $fillable = [
        'asuntoComentarioInversion',
        'comentariosInversion',
        'fechaComentarioInversion',
        'idInversion',
        'idUsuario',
        
    ];

    // Define la relación con el modelo Inversion
    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'idInversion');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
}
