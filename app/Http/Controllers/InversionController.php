<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Inversion;
class InversionController extends Controller
{
    public function index(Request $request){
        $inversiones = Inversion::all();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        return view('inversion.index', compact('inversiones', 'provincias'));
    }

    public function create(){
        return view('inversion.create');
    }

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
        $inversiones = Inversion::all();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        return view('inversion.edit', compact('inversiones', 'provincias'));

        //$inversion = Inversion::findOrFail($id);
        //return view('inversion.edit',compact('inversion'));
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