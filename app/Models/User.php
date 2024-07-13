<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define la clave primaria
    protected $primaryKey = 'idUsuario';

    // Define los atributos asignables en masa
    protected $fillable = [
        'nombreUsuario',
        'apellidoUsuario',
        'email',
        'password',
        'isAdmin',
        'categoriaUsuario',
    ];

    protected $hidden = [
        'password',
    ];

    public function adminlte_image()
    {
        return asset('images/profile.png');
    }

    public function adminlte_desc()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        return $this->nombreUsuario . " " . $this->apellidoUsuario;
    }

    // Define la relación inversa con el modelo Segmento
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idUsuario', 'idUsuario');
    }

    public function profesiones() {
        return $this->hasMany(Profesiones::class, 'idUsuario', 'idUsuario');
    }

    public function especialidades() {
        return $this->hasMany(Especialidades::class, 'idUsuario', 'idUsuario');
    }

    public function inversion(){
        return $this->hasMany(Inversion::class, 'idUsuario', 'idUsuario');
    }

    public function asignacion_especialidad(){
        return $this->hasMany(Especialidad::class, 'idUsuario', 'idUsuario');
    }
}
