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

    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $request->validate([
            'asuntoComentarioInversion' => 'required|string|max:255',
            'comentariosInversion' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'asuntoComentarioInversion.required' => 'El nombre es obligatorio.',
            'comentariosInversion.required' => 'La obervación es obligatoria.',
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
        $data['fechaComentarioInversion'] = Carbon::now(); // <- Asignar fecha actual automáticamente

        // Crear el registro
        ComentarioInversion::create($data);
            return redirect()->route('comentario.index')->with('message','Comentario creado correctamente.');
    }

    public function show($id)
    {
        $comentarios = ComentarioInversion::findOrFail($id);

        $user = Auth::user();

        if ($comentarios->idUsuario !== Auth::id() && !$user->isAdmin) {
            abort(403, 'No tienes permiso para ver este comentario.');
        }


        return view('comentario.show', compact('comentarios'));
    }

    public function edit($id)
    {
        // Mostrar el formulario para editar
        $comentarios = ComentarioInversion::findOrFail($id);
        $inversiones = Inversion::all();
        //$usuarios = User::all();
        $user = Auth::user();

        if ($comentarios->idUsuario !== Auth::id() && !$user->isAdmin) {
            abort(403, 'No tienes permiso para editar este comentario.');
        }

        return view('comentario.edit', compact('comentarios','inversiones'));
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('America/Lima');
         // Validaciones
         $request->validate([
            'asuntoComentarioInversion' => 'required|string|max:255',
            'comentariosInversion' => 'required|string|max:255',
            'idInversion' => 'required|exists:inversion,idInversion',
        ],[
            'asuntoComentarioInversion.required' => 'El nombre es obligatorio.',
            'comentariosInversion.required' => 'La obervación es obligatoria.',
            'idInversion.required' => 'La inversión es obligatoria.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
        ]);

        // Buscamos el complementario
        $comentarios = ComentarioInversion::findOrFail($id);

        if (!Auth::check()) {
            return redirect()->route('comentario.index')->withErrors('Debe estar autenticado para realizar esta acción.');
        }

        // Agregar el ID del usuario autenticado al arreglo de datos
        $data = $request->all();
        $data['idUsuario'] = Auth::user()->idUsuario; // Asigna el ID del usuario autenticado
        $data['fechaComentarioInversion'] = Carbon::now();
            // Editamos el complementario
        $comentarios->update($data);

        return redirect()->route('comentario.index')->with('message', 'Comentario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $comentarios = ComentarioInversion::findOrFail($id);
        $user = Auth::user();

        if ($comentarios->idUsuario !== Auth::id() && !$user->isAdmin) {
            abort(403, 'No tienes permiso para borrar este comentario.');
        }
        $comentarios->delete();

        return redirect()->route('comentario.index')->with('message','Comentario ' . $comentarios->asuntoComentarioInversion . ' eliminada exitosamente.');
    }
}
