<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'nombreFase',
        'porcentajeFase',
        'idEspecialidad'
    ];
}
