<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfase extends Model
{
    protected $fillable = [
        'nombreSubfase',
        'fechaInicioSubfase',
        'fechaFinalSubfase',
        'idFase'
    ];
}
