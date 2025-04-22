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
        'ObservacionUser',
        'password_changed',
    ];

    // Ocultamos el campo password
    protected $hidden = [
        'password',
    ];

    // Relación uno a muchos: Un usuario puede tener varios segmentos
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Un usuario puede tener varias profesiones
    public function profesiones()
    {
        return $this->hasMany(Profesiones::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Un usuario puede tener varias especialidades
    public function especialidades()
    {
        return $this->hasMany(Especialidades::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Un usuario puede tener varias inversiones (como profesional)
    public function inversiones()
    {
        return $this->hasMany(Inversion::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Un usuario puede ser coordinador de varias inversiones
    public function inversionesComoCoordinador()
    {
        return $this->hasMany(Inversion::class, 'idCordinador', 'idUsuario');
    }

    // Relación muchos a muchos: Un usuario puede estar asociado a varias especialidades a través de la tabla pivote
    public function especialidad_users()
    {
        return $this->belongsToMany(Especialidad::class, 'especialidad_users', 'idUsuario', 'idEspecialidad');
    }

    // Relación uno a muchos: Un usuario puede tener varias asignaciones como profesional
    public function asignacionesProfesional()
    {
        return $this->hasMany(AsignacionProfesional::class, 'idUsuario', 'idUsuario');
    }

    // Relación uno a muchos: Un usuario puede tener varias asignaciones como asistente
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