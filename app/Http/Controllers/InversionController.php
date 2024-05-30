<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
class InversionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Inversion::query();

        if ($search) {
            $query->where('nombreInversion', 'LIKE', "%{$search}%")
                  ->orWhere('nombreCortoInversion', 'LIKE', "%{$search}%")
                  ->orWhere('provinciaInversion', 'LIKE', "%{$search}%")
                  ->orWhere('distritoInversion', 'LIKE', "%{$search}%");
        }

        $inversiones = $query->paginate(10);

        return view('inversion.index', compact('inversiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inversion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Aquí debes definir las reglas de validación para tus campos
        ]);

        Inversion::create($request->all());

        return redirect()->route('inversion.index')->with('success','Inversión creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inversion = Inversion::findOrFail($id);
        return view('inversion.edit',compact('inversion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // Aquí debes definir las reglas de validación para tus campos
        ]);

        $inversion = Inversion::findOrFail($id);
        $inversion->update($request->all());

        return redirect()->route('inversion.index')->with('success','Inversión actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inversion = Inversion::findOrFail($id);
        $inversion->delete();

        return redirect()->route('inversion.index')->with('success','Inversión eliminada exitosamente.');
    }
    public function show($id)
    {
    $inversion = Inversion::findOrFail($id);
    return view('inversion.show', compact('inversion'));
    }
}