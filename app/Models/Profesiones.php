<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesiones extends Model
{
    use HasFactory;

    // Define la tabla asociada con el modelo
    protected $table = 'profesiones';

    // Define los atributos asignables en masa
    protected $fillable = [
        'idUsuario',
        'nombreProfesion'
    ];

    // Desactiva los timestamps si no se usan
    public $timestamps = false;

    // Define la relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
}
