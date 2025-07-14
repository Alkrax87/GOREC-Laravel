<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\ComentarioInversion;
use Carbon\Carbon;
use App\Models\User;
use Auth;
class ComentarioControllerInversion extends Controller
{
    public function index()
    {
        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            /*
                Si el usuario es administrador, carga todas las inversiones
            */
            $inversiones = Inversion::all();
            $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();
            $comentarios = ComentarioInversion::all();

        } else {
            /*
                Si no es administrador, carga las inversiones asignadas como Responsable,
                Coordinador y aquellas en las que ha sido asignado como profesional
            */
            $inversionesResponsable = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionesCoordinador = Inversion::whereHas('coordinadores', function ($query) use ($user) {
                $query->where('users.idUsuario', $user->idUsuario);
            })->get();
            $inversionesProfesional = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combinamos las inversiones asignadas al usuario
            $inversiones = $inversionesResponsable
                ->merge($inversionesCoordinador)
                ->merge($inversionesProfesional)
                ->unique('idInversion');

            // Carga los usuarios relacionados
            $usuarios = User::where('idUsuario', $user->idUsuario)->get();
            $comentarios = ComentarioInversion::whereIn('idInversion', $inversiones->pluck('idInversion'))->get();
            //$comentarios  = ComentarioInversion::whereIn('idInversion', $inversiones)->get();

        }

        // Carga las notificaciones de las inversiones por finalizar
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

        // Verifica si el usuario es coordinador en alguna inversión
        $esCoordinador = Inversion::whereHas('coordinadores', function ($query) use ($user) {
            $query->where('users.idUsuario', $user->idUsuario);
        })->exists();

        // Solo bloqueamos el acceso si NO es admin, NO es coordinador y NO es el autor del comentario
        if (!$user->isAdmin && !$esCoordinador && $comentarios->idUsuario !== Auth::id()) {
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

    // Solo permitir si es administrador
    if (!$user->isAdmin) {
        abort(403, 'Solo el administrador puede borrar comentarios.');
    }

    $comentarios->delete();

        return redirect()->route('comentario.index')->with('message','Comentario ' . $comentarios->asuntoComentarioInversion . ' eliminada exitosamente.');
    }
}
