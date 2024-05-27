<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Usuarios::paginate(10); // CambInversion::
        return view('usuario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Aquí debes definir las reglas de validación para tus campos
        ]);

        Usuarios::create($request->all());

        return redirect()->route('usuario.index')->with('success','Inversión creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreUsuarios' => 'required|string|max:255',
            'apellidoUsuarios' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'profesionUsuarios' => 'nullable|string|max:255',
            'especialidadUsuarios' => 'nullable|string|max:255',
        ]);

        // Buscar el usuario por ID
        $usuario = Usuarios::findOrFail($id);

        // Actualizar los datos del usuario
        $usuario->update($request->all());

        return redirect()->route('usuario.index')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success','Inversión eliminada exitosamente.');
    }
    public function show($id)
    {
    $usuario = Usuarios::findOrFail($id);
    return view('usuario.show', compact('usuario'));
    }
}
