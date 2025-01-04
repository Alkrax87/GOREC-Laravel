<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Inversion;
use Carbon\Carbon;
use Auth;
use Hash;

class UserController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $usuarios = User::with(['inversion', 'asignacionesProfesional.inversion', 'asignacionesAsistente.inversion'])->get();
        $inversiones = Inversion::all();

        $notificaciones = [];

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('usuario.index', compact('usuarios','notificaciones'),);
    }

    // Función que devuelve el formulario de crear
    public function create(){
        return view('usuario.create');
    }

    // Función de agreagar un registro
    public function store(Request $request){
        // Inicio validacion usuario
        $request->merge(['email' => $request->email . '@gorec.com']);

        // Validaciones
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'nullable|string|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'categoriaUsuario' => 'required|string',
            'profesionUsuario' => 'array',
            'especialidadUsuario' => 'array',
            'ObservacionUser' => 'nullable|string|max:1024',
            
        ], [
            'nombreUsuario.required' => 'El campo de nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo de apellido es obligatorio.',
            'email.unique' => 'El nombre de usuario  ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo de categoría es obligatorio.',
            'profesionUsuario.required' => 'El campo de profesión es obligatorio.',
            'especialidadUsuario.required' => 'El campo de especialidad es obligatorio.',
        ]);

        // Fin validacion usuario
        $request->merge(['email' => str_replace('@gorec.com', '', $request->email)]);

        // Preparar los datos para crear
        $data = [
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'categoriaUsuario' => $request->categoriaUsuario,
        ];

        // Validamos si el Usuario ingresado va a tener o no un usuario y contraseña
        if ($request->email == null && $request->password == null) {
            $data['email'] = null;
            $data['password'] = null;
        } else {
            $data['email'] = $request->email . '@gorec.com';
            $data['password'] = Hash::make($request->password);
        }

        // Creamos un nuevo Usuario
        $usuario = User::create($data);

        // Guardar profesiones
        if ($request->has('profesionUsuario')) {
            foreach ($request->profesionUsuario as $profesion) {
                $usuario->profesiones()->create(['nombreProfesion' => $profesion]);
            }
        }

        // Guardar especialidades
        if ($request->has('especialidadUsuario')) {
            foreach ($request->especialidadUsuario as $especialidad) {
                $usuario->especialidades()->create(['nombreEspecialidad' => $especialidad]);
            }
        }

        return redirect()->route('usuario.index')->with('message','Usuario ' . $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario . ' creado correctamente.');
    }

    // Función cargar un elemento en editar
    public function edit($id){
        // Carga el usuario con un id especifico
        $usuario = User::findOrFail($id);

        return view('usuario.edit',compact('usuario'));
    }

    // Función editar un registro
    public function update(Request $request, $id){
        // Inicio validacion usuario
        $request->merge(['email' => $request->email . '@gorec.com']);

        // Validaciones
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users')->ignore($id, 'idUsuario')// Validación única excepto para el usuario actual
            ],
            'password' => 'nullable|string|min:8',
            'categoriaUsuario' => 'required|string',
            'profesionUsuario' => 'array',
            'especialidadUsuario' => 'array',
            'ObservacionUser' => 'nullable|string|max:1024',
        ], [
            'nombreUsuario.required' => 'El campo de nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo de apellido es obligatorio.',
            'email.unique' => 'El nombre de usuario  ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo de categoría es obligatorio.',
            'profesionUsuario.required' => 'El campo de profesión es obligatorio.',
            'especialidadUsuario.required' => 'El campo de especialidad es obligatorio.',
        ]);

        // Fin validacion usuario
        $request->merge(['email' => str_replace('@gorec.com', '', $request->email)]);

        // Buscar el usuario por id
        $usuario = User::findOrFail($id);

        // Preparar los datos para actualizar
        $data = [
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'email' => $request->filled('email') ? $request->email . '@gorec.com' : null,
            'categoriaUsuario' => $request->categoriaUsuario,
            'ObservacionUser' => $request->input('ObservacionUser'),
        ];

        // Actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Validamos si el Usuario ingresado va a tener o no un usuario y contraseña
        if ($request->email == null && $request->password == null) {
            $data['password'] = null;
            $data['isAdmin'] = false;
        }

        // Aplicar los cambios y guardar el usuario
        $usuario->update($data);

        // Eliminar todas las profesiones y especialidades actuales del usuario
        $usuario->profesiones()->delete();
        $usuario->especialidades()->delete();

        // Guardar nuevas profesiones
        if ($request->has('profesionUsuario')) {
            foreach ($request->profesionUsuario as $profesion) {
                $usuario->profesiones()->create(['nombreProfesion' => $profesion]);
            }
        }

        // Guardar nuevas especialidades
        if ($request->has('especialidadUsuario')) {
            foreach ($request->especialidadUsuario as $especialidad) {
                $usuario->especialidades()->create(['nombreEspecialidad' => $especialidad]);
            }
        }

        return redirect()->route('usuario.index')->with('message', 'Usuario ' . $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario . ' actualizado correctamente.');
    }

    // Función eliminar un registro
    public function destroy($id){
        // Carga el usuario con un id especifico para eliminar
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('message','Usuario ' . $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario . ' eliminado correctamente.');
    }

    // Función mostrar un registro
    public function show($id){
        $usuario = User::findOrFail($id);

        return view('usuario.show', compact('usuario'));
    }

    public function showChangePasswordForm()
    {
        return view('password_change'); // Asegúrate de que la vista exista
    }

    public function updatePassword(Request $request)
{
    try {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->password_changed = true;
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente.']);
    } catch (\Exception $e) {
        \Log::error('Error al actualizar la contraseña: ' . $e->getMessage());
        return response()->json(['message' => 'Error al actualizar la contraseña.'], 500);
    }
}

}