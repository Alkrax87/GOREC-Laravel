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
        // Cargamos los datos de usuarios y las inversiones
        $usuarios = User::all();
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

    // Función de agreagar un registro
    public function store(Request $request){
        // Validaciones
        $request->merge(['email' => $request->email . '@gorec.com']);

        // Validaciones
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => 'nullable|string|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'categoriaUsuario' => 'required|string',
            'profesionUsuario' => 'required|array',
            'especialidadUsuario' => 'required|array',
            'ObservacionUser' => 'nullable|string|max:1024',
        ], [
            'nombreUsuario.required' => 'El campo Nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo Apellido es obligatorio.',
            'email.unique' => 'El nombre de Usuario ya está en uso.',
            'password.min' => 'La Contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo Categoría es obligatorio.',
            'profesionUsuario.required' => 'El campo Profesión es obligatorio.',
            'especialidadUsuario.required' => 'El campo Especialidad es obligatorio.',
        ]);

        // Fin validación usuario
        $request->merge(['email' => str_replace('@gorec.com', '', $request->email)]);

        // Preparar los datos para crear
        $data = [
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'categoriaUsuario' => $request->categoriaUsuario,
        ];

        if ($request->cuentaUsuario && $request->email !== null && $request->password !== null) {
            $data['email'] = $request->email . '@gorec.com';
            $data['password'] = Hash::make($request->password);
        } else {
            $data['email'] = null;
            $data['password'] = null;
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

        $inversiones = Inversion::all();

        $notificaciones = [];

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('usuario.edit',compact('usuario', 'notificaciones'));
    }

    // Función editar un registro
    public function update(Request $request, $id){
        // Inicio validacion usuario
        $request->merge(['email' => $request->email . '@gorec.com']);

        // Validaciones
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'apellidoUsuario' => 'required|string|max:255',
            'email' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($id, 'idUsuario')],
            'password' => 'nullable|string|min:8',
            'categoriaUsuario' => 'required|string',
            'profesionUsuario' => 'required|array',
            'especialidadUsuario' => 'required|array',
            'ObservacionUser' => 'nullable|string|max:1024',
        ], [
            'nombreUsuario.required' => 'El campo Nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo Apellido es obligatorio.',
            'email.unique' => 'El nombre de Usuario ya está en uso.',
            'password.min' => 'La Contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo Categoría es obligatorio.',
            'profesionUsuario.required' => 'El campo Profesión es obligatorio.',
            'especialidadUsuario.required' => 'El campo Especialidad es obligatorio.',
        ]);

        // Fin validacion usuario
        $request->merge(['email' => str_replace('@gorec.com', '', $request->email)]);

        // Buscar el usuario por id
        $usuario = User::findOrFail($id);

        // Preparar los datos para actualizar
        $data = [
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'categoriaUsuario' => $request->categoriaUsuario,
            'ObservacionUser' => $request->observacionUsuario,
        ];
        if ($request->cuentaUsuario && $request->filled('email')) {
            $data['email'] = $request->email . '@gorec.com';
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
                $data['password_changed'] = false;
            }
        } else {
            $data['email'] = null;
            $data['password'] = null;
            $data['isAdmin'] = false;
            $data['isAdministrativo'] = false;
            $data['password_changed'] = false;
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

        $inversiones = Inversion::all();

        $notificaciones = [];

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        return view('usuario.show', compact('usuario', 'notificaciones'));
    }

    public function showChangePasswordForm(){
        return view('password_change');
    }

    public function updatePassword(Request $request){
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