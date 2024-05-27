<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //use HasFactory;
    protected $table = 'usuarios';
    protected $fillable = [
        'nombreUsuarios',
        'apellidoUsuarios',
        'email',
        'password',
        'profesionUsuarios',
        'especialidadUsuarios',
    ];
    protected $primaryKey = 'idUser';
}
