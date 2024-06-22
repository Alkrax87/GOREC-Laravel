<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Especialidad;
use App\Models\Fase;
use App\Models\Subfase;
class ProyectoController extends Controller
{

    public function index()
    {
        // Obtener todos los proyectos con sus relaciones cargadas
        $proyectos = Inversion::with('especialidades.fases.subfases')->get();

        // Retornar la vista con los datos
        return view('avanzeProyecto.index', compact('proyectos'));
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombreProyecto' => 'required|string',
            'porcentajeEspecialidad' => 'required|integer',
            'nombreFase' => 'required|string',
            'porcentajeFase' => 'required|integer',
            'nombreSubfase' => 'required|string',
            'fechaInicioSubfase' => 'required|date',
            'fechaFinalSubfase' => 'required|date'
        ]);

        // Crear el Proyecto
        $proyecto = Inversion::create([
            'nombreProyecto' => $request->nombreProyecto,
            // Agrega el resto de campos del proyecto
        ]);

        // Crear la Especialidad asociada al Proyecto
        $especialidad = Especialidad::create([
            'porcentajeEspecialidad' => $request->porcentajeEspecialidad,
            'idProyecto' => $proyecto->id
        ]);

        // Crear la Fase asociada a la Especialidad
        $fase = Fase::create([
            'nombreFase' => $request->nombreFase,
            'porcentajeFase' => $request->porcentajeFase,
            'idEspecialidad' => $especialidad->id
        ]);

        // Crear la Subfase asociada a la Fase
        $subfase = Subfase::create([
            'nombreSubfase' => $request->nombreSubfase,
            'fechaInicioSubfase' => $request->fechaInicioSubfase,
            'fechaFinalSubfase' => $request->fechaFinalSubfase,
            'idFase' => $fase->id
        ]);

        // Si llegamos a este punto sin errores, redireccionamos de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Datos guardados correctamente');
    }
}
