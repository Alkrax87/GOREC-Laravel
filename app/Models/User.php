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
        'isAdministrativo',
        'categoriaUsuario',
    ];

    // Ocultamos el campo password
    protected $hidden = [
        'password',
    ];

    // Define la relación con el modelo Segmento
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idUsuario', 'idUsuario');
    }

    // Define la relación con el modelo Profesiones
    public function profesiones()
    {
        return $this->hasMany(Profesiones::class, 'idUsuario', 'idUsuario');
    }

    // Define la relación con el modelo Eespecialidades
    public function especialidades()
    {
        return $this->hasMany(Especialidades::class, 'idUsuario', 'idUsuario');
    }

    // Define la relación con el modelo Inversión
    public function inversion()
    {
        return $this->hasMany(Inversion::class, 'idUsuario', 'idUsuario');
    }

    // Define la relación con el modelo EspecialidadUsers
    public function especialidad_users()
    {
        return $this->belongsToMany(Especialidad::class, 'especialidad_users', 'idUsuario', 'idEspecialidad');
    }

    public function asignacionesProfesional()
    {
        return $this->hasMany(AsignacionProfesional::class, 'idUsuario', 'idUsuario');
    }

    public function asignacionesAsistente()
    {
        return $this->hasMany(AsignacionAsistente::class, 'idAsistente', 'idUsuario');
    }

    // ---------------------------------
    // -----------AdminLTE--------------
    // ---------------------------------

    // Cargamos la imagen del perfil
    public function adminlte_image()
    {
        return asset('images/profile.png');
    }

    // Obtener el usuario autenticado
    public function adminlte_desc()
    {
        $user = Auth::user();
        return $this->nombreUsuario . " " . $this->apellidoUsuario;
    }
}