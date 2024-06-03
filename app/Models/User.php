<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'profesionUsuario',
        'especialidadUsuario',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'I\'m a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

    // Define la relación inversa con el modelo Segmento
    public function segmentos()
    {
        return $this->hasMany(Segmento::class, 'idUsuario', 'idUsuario');
    }
}
