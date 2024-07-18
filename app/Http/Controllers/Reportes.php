<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subfase;
use App\Models\Especialidad;
use App\Models\Inversion;
class Reportes extends Controller
{
    //
    public function index(){
        $especialidades = Especialidad::all();
        $subfases = Subfase::all();
        $inversiones = Inversion::all();
        //$subfases = Subfase::select('fechaInicioSubfase', 'avanceRealTotalSubFase')->get();
        // Pasar los datos a la vista
        return view('reportes.graficos', compact('subfases','especialidades','inversiones'));
       
    }
}
