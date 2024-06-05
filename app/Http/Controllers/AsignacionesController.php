<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Inversion;
use App\Models\User;
use App\Models\AsignacionProfesional;

class AsignacionesController extends Controller
{
    public function index(Request $request){
        $inversiones = Inversion::all();
        $usuarios = User::all();
        $profesionales = AsignacionProfesional::all();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        return view('asignaciones.index', compact('inversiones','provincias','usuarios','profesionales'));
    }

    public function create(){
        return view('asignaciones.profesional.create', compact('profesionales'));
    }

    public function store(Request $request){
        $request->validate([
            //
        ]);

        AsignacionProfesional::create([
            'idInversion' => 3,
            'idUsuario' => $request->idUsuario,
        ]);


        return redirect()->route('asignaciones.index')->with('message','Elemento creado correctamente.');
    }

    public function destroy($id) {
        $deleted = AsignacionProfesional::where('idUsuario', $id)->delete();
        return redirect()->route('asignaciones.index')->with('message', 'Elementos eliminados correctamente.');
    }
}
