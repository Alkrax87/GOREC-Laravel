<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function index(Request $request){
        // Carga todos los usuarios y los retornamos en la vista index
        $usuarios = User::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create(){
        // Retornamos vista de crear
        return view('usuario.create');
    }

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
        ], [
            'nombreUsuario.required' => 'El campo de nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo de apellido es obligatorio.',
            'email.unique' => 'El nombre de usuario  ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo de categoría es obligatorio.',
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

        // Retornamos la vista inicial
        return redirect()->route('usuario.index')->with('message','Elemento creado correctamente.');
    }

    public function show($id){
        // Carga el usuario con un id especifico y los retornamos en la vista de mostrar
        $usuario = User::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }

    public function edit($id){
        // Carga el usuario con un id especifico y los retornamos en la vista de editar
        $usuario = User::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
    }

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
        ], [
            'nombreUsuario.required' => 'El campo de nombre es obligatorio.',
            'apellidoUsuario.required' => 'El campo de apellido es obligatorio.',
            'email.unique' => 'El nombre de usuario  ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'categoriaUsuario.required' => 'El campo de categoría es obligatorio.',
        ]);

        // Fin validacion usuario
        $request->merge(['email' => str_replace('@gorec.com', '', $request->email)]);

        // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        // Preparar los datos para actualizar
        $data = [
            'nombreUsuario' => $request->nombreUsuario,
            'apellidoUsuario' => $request->apellidoUsuario,
            'email' => $request->filled('email') ? $request->email . '@gorec.com' : null,
            'categoriaUsuario' => $request->categoriaUsuario,
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

        // Retornamos la vista inicial
        return redirect()->route('usuario.index')->with('message', 'Elemento actualizado correctamente.');
    }

    public function destroy($id){
        // Carga el usuario con un id especifico para eliminar y los retornamos en la vista inical
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuario.index')->with('message','Elemento eliminado correctamente.');
    }

}
