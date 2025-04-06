<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\ComentarioInversion;
use Carbon\Carbon;
use Auth;
class ComentarioControllerInversion extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin) {
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
            $comentarios = ComentarioInversion::all();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');

            $inversionIds = $inversiones->pluck('idInversion');
            $comentarios  = ComentarioInversion::whereIn('idInversion', $inversionIds)->get();
        }

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('comentario.index', compact('comentarios', 'inversiones','notificaciones'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'asuntoComentarioInversion' => 'required|string|max:255',
            'comentariosInversion' => 'required|string|max:255',
            'fechaComentarioInversion' => 'required|date',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'asuntoComentarioInversion.required' => 'El nombre es obligatorio.',
            'comentariosInversion.required' => 'La obervación es obligatoria.',
            'fechaComentarioInversion.required' => 'La fecha inicio es obligatoria.',
            'fechaComentarioInversion.date' => 'La fecha final debe ser una fecha válida.',
            'idInversion.required' => 'La inversión es obligatoria.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
        ]);

       // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('comentario.index')->withErrors('Debe estar autenticado para realizar esta acción.');
        }

        // Agregar el ID del usuario autenticado al arreglo de datos
        $data = $request->all();
        $data['idUsuario'] = Auth::user()->idUsuario;  // Asigna el ID del usuario autenticado

        // Crear el registro
        ComentarioInversion::create($data);
            return redirect()->route('comentario.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id)
    {
        // Mostrar un producto específico
    }

    public function edit($id)
    {
        // Mostrar el formulario para editar
        $comentarios = ComentarioInversion::findOrFail($id);
        $inversiones = Inversion::all();
        //$usuarios = User::all();

        return view('comentario.edit', compact('comentarios','inversiones'));
    }

    public function update(Request $request, $id)
    {
        // Actualizar el producto
    }

    public function destroy($id)
    {
        // Eliminar el producto
    }
}
