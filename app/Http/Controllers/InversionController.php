<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Inversion;
use App\Models\User;

class InversionController extends Controller
{
    public function index(Request $request){
        $inversiones = Inversion::all();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        $usuarios = User::whereNotNull('email')->get();
        return view('inversion.index', compact('inversiones', 'provincias', 'usuarios'));
    }

    public function create(){
        return view('inversion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:255',
            'nombreCortoInversion' => 'required|string|max:255',
            'nivelInversion' => 'required|string|max:255',
            'provinciaInversion' => 'required|string|max:255',
            'distritoInversion' => 'required|string|max:255',
            'funcionInversion' => 'required|string|max:255',
            'presupuestoFormulacionInversion' => 'required|numeric|between:0,9999999999999.99',
            'presupuestoEjecucionfuncionInversion' => 'required|numeric|between:0,9999999999999.99',
            'modalidadEjecucionInversion' => 'required|string|max:255',
            'estadoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
            'fechaModificacionEstadoInversion' => 'nullable|string|max:255',
            'avanceTotalInversion' => 'nullable|string|max:255',
            'fechaInicioInversion' => 'required|date',
            'fechaFinalInversion' => 'required|date',
        ], [
            'cuiInversion.required' => 'El campo CUI Inversión es obligatorio.',
            'nombreInversion.required' => 'El campo Nombre de Inversión es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto de Inversión es obligatorio.',
            'nivelInversion.required' => 'El campo Nivel de Inversión es obligatorio.',
            'provinciaInversion.required' => 'El campo Provincia de Inversión es obligatorio.',
            'distritoInversion.required' => 'El campo Distrito de Inversión es obligatorio.',
            'funcionInversion.required' => 'El campo Función de Inversión es obligatorio.',
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación de Inversión es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación de Inversión debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulación de Inversión debe estar entre 0 y 9999999999999.99.',
            'presupuestoEjecucionfuncionInversion.required' => 'El campo Presupuesto de Ejecución de Inversión es obligatorio.',
            'presupuestoEjecucionfuncionInversion.numeric' => 'El campo Presupuesto de Ejecución de Inversión debe ser un número.',
            'presupuestoEjecucionfuncionInversion.between' => 'El campo Presupuesto de Ejecución de Inversión debe estar entre 0 y 9999999999999.99.',
            'modalidadEjecucionInversion.required' => 'El campo Modalidad de Ejecución de Inversión es obligatorio.',
            'estadoInversion.required' => 'El campo Estado de Inversión es obligatorio.',
            'idUsuario.required' => 'El Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
            'fechaInicioInversion.required' => 'El campo Fecha de Inicio de Inversión es obligatorio.',
            'fechaInicioInversion.date' => 'El campo Fecha de Inicio de Inversión debe ser una fecha válida.',
            'fechaFinalInversion.required' => 'El campo Fecha Final de Inversión es obligatorio.',
            'fechaFinalInversion.date' => 'El campo Fecha Final de Inversión debe ser una fecha válida.',
        ]);

        Inversion::create($request->all());

        return redirect()->route('inversion.index')->with('success','Inversión creada exitosamente.');
    }

    public function edit($id)
    {
        $inversiones = Inversion::all();
        $json = File::get(public_path('json/cusco.json'));
        $data = json_decode($json, true);
        $provincias = $data['provincias'];
        return view('inversion.edit', compact('inversiones', 'provincias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cuiInversion' => 'required|string|max:255',
            'nombreInversion' => 'required|string|max:255',
            'nombreCortoInversion' => 'required|string|max:255',
            'nivelInversion' => 'required|string|max:255',
            'provinciaInversion' => 'required|string|max:255',
            'distritoInversion' => 'required|string|max:255',
            'funcionInversion' => 'required|string|max:255',
            'presupuestoFormulacionInversion' => 'required|numeric|between:0,9999999999999.99',
            'presupuestoEjecucionfuncionInversion' => 'required|numeric|between:0,9999999999999.99',
            'modalidadEjecucionInversion' => 'required|string|max:255',
            'estadoInversion' => 'required|string|max:255',
            'idUsuario' => 'required|exists:users,idUsuario',
            'fechaModificacionEstadoInversion' => 'nullable|string|max:255',
            'avanceTotalInversion' => 'nullable|string|max:255',
            'fechaInicioInversion' => 'required|date',
            'fechaFinalInversion' => 'required|date',
        ], [
            'cuiInversion.required' => 'El campo CUI Inversión es obligatorio.',
            'nombreInversion.required' => 'El campo Nombre de Inversión es obligatorio.',
            'nombreCortoInversion.required' => 'El campo Nombre Corto de Inversión es obligatorio.',
            'nivelInversion.required' => 'El campo Nivel de Inversión es obligatorio.',
            'provinciaInversion.required' => 'El campo Provincia de Inversión es obligatorio.',
            'distritoInversion.required' => 'El campo Distrito de Inversión es obligatorio.',
            'funcionInversion.required' => 'El campo Función de Inversión es obligatorio.',
            'presupuestoFormulacionInversion.required' => 'El campo Presupuesto de Formulación de Inversión es obligatorio.',
            'presupuestoFormulacionInversion.numeric' => 'El campo Presupuesto de Formulación de Inversión debe ser un número.',
            'presupuestoFormulacionInversion.between' => 'El campo Presupuesto de Formulación de Inversión debe estar entre 0 y 9999999999999.99.',
            'presupuestoEjecucionfuncionInversion.required' => 'El campo Presupuesto de Ejecución de Inversión es obligatorio.',
            'presupuestoEjecucionfuncionInversion.numeric' => 'El campo Presupuesto de Ejecución de Inversión debe ser un número.',
            'presupuestoEjecucionfuncionInversion.between' => 'El campo Presupuesto de Ejecución de Inversión debe estar entre 0 y 9999999999999.99.',
            'modalidadEjecucionInversion.required' => 'El campo Modalidad de Ejecución de Inversión es obligatorio.',
            'estadoInversion.required' => 'El campo Estado de Inversión es obligatorio.',
            'idUsuario.required' => 'El Usuario es obligatorio.',
            'idUsuario.exists' => 'El usuario seleccionado no existe en la tabla de usuarios.',
            'fechaInicioInversion.required' => 'El campo Fecha de Inicio de Inversión es obligatorio.',
            'fechaInicioInversion.date' => 'El campo Fecha de Inicio de Inversión debe ser una fecha válida.',
            'fechaFinalInversion.required' => 'El campo Fecha Final de Inversión es obligatorio.',
            'fechaFinalInversion.date' => 'El campo Fecha Final de Inversión debe ser una fecha válida.',
        ]);

        $inversion = Inversion::findOrFail($id);
        $inversion->update($request->all());

        return redirect()->route('inversion.index')->with('success','Inversión actualizada exitosamente.');
    }

    public function destroy($id){
        $inversion = Inversion::findOrFail($id);
        $inversion->delete();
        return redirect()->route('inversion.index')->with('success','Inversión eliminada exitosamente.');
    }

    public function show($id){
        $inversion = Inversion::findOrFail($id);
        return view('inversion.show', compact('inversion'));
    }
}