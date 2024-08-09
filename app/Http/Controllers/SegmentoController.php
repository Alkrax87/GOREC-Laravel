<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segmento;
use App\Models\Inversion;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class SegmentoController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Cargamos los datos de filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
            $segmentos = Segmento::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionIds = $inversiones->pluck('idInversion');
            $segmentos = Segmento::whereIn('idInversion', $inversionIds)->get();
        }

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 48) {
                $notificaciones[] = $inversion;
            }
        }

        // Carga de datos de usuarios
        $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        return view('segmento.index', compact('segmentos', 'inversiones', 'usuarios','notificaciones'));
    }

    // Función que devuelve el formulario de crear
    public function create(){
        return view('segmento.create', compact('inversiones'));
    }

    // Función de agregar un registro
    public function store(Request $request){
        //Validaciones
        $request->validate([
            'nombreSegmento' => 'required|string|max:255',
            'fechaInicioSegmento' => 'required|date',
            'fechaFinalSegmento' => 'required|date|after_or_equal:fechaInicioSegmento',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'required|exists:users,idUsuario',
        ],[
            'nombreSegmento.required' => 'El campo nombre es obligatorio.',
            'fechaInicioSegmento.required' => 'El campo fecha inicio es obligatorio.',
            'fechaInicioSegmento.date' => 'El campo fecha inicio debe ser una fecha válida.',
            'fechaFinalSegmento.required' => 'El campo fecha final es obligatorio.',
            'fechaFinalSegmento.date' => 'El campo fecha final debe ser una fecha válida.',
            'fechaFinalSegmento.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe.',
        ]);

        // Creamos un nuevo Segmento
        Segmento::create($request->all());

        return redirect()->route('segmento.index')->with('message','Elemento creado correctamente.');
    }

    public function edit($id){
        // Carga el segmento con un id especifico
        $segmento = Segmento::findOrFail($id);

        return view('segmento.edit', compact('segmento'));
    }

    public function update(Request $request, $id){
        //Validaciones
        $request->validate([
            'nombreSegmento' => 'required|string|max:255',
            'fechaInicioSegmento' => 'required|date',
            'fechaFinalSegmento' => 'required|date|after_or_equal:fechaInicioSegmento',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'required|exists:users,idUsuario',
        ],[
            'nombreSegmento.required' => 'El campo nombre es obligatorio.',
            'fechaInicioSegmento.required' => 'El campo fecha inicio es obligatorio.',
            'fechaInicioSegmento.date' => 'El campo fecha inicio debe ser una fecha válida.',
            'fechaFinalSegmento.required' => 'El campo fecha final es obligatorio.',
            'fechaFinalSegmento.date' => 'El campo fecha final debe ser una fecha válida.',
            'fechaFinalSegmento.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe.',
        ]);

        // Carga el segmento con un id especifico
        $segmento = Segmento::findOrFail($id);

        // Aplicar los cambios y guardar el segmento
        $segmento->update($request->all());

        return redirect()->route('segmento.index')->with('message', 'Elemento actualizado correctamente.');
    }

    // Función eliminar un registro
    public function destroy($id){
        // Carga el segmento con un id especifico para eliminar
        $segmento = Segmento::findOrFail($id);
        $segmento->delete();

        return redirect()->route('segmento.index')->with('message','Elemento eliminado correctamente.');
    }

    // Función mostrar un registro
    public function show($id){
        // Buscamos un segmento
        $segmento = Segmento::with(['inversion', 'usuario'])->findOrFail($id);

        return view('segmento.show', compact('segmento'));
    }
}