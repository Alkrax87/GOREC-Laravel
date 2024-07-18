<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\User;
use App\Models\Especialidad;
use App\Models\SubFase;
use App\Models\Fase;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        $this->recalcularAvanceTotalEspecialidad();
        $especialidades = Especialidad::all();
        $fases = Fase::all();
        $subfases = SubFase::all();
        $inversiones = Inversion::all();
        $usuarios = User::all(); // Carga todas las inversiones
        
        return view('especialidad.index', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'array',
            'idUsuario' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
        ]);

        // Crear la nueva especialidad
        $especialidad = new Especialidad();
        $especialidad->nombreEspecialidad = $request->nombreEspecialidad;
        $especialidad->porcentajeAvanceEspecialidad = $request->porcentajeAvanceEspecialidad;
        $especialidad->avanceTotalEspecialidad = 0; // Inicializar con 0
        $especialidad->idInversion = $request->idInversion;
       

        $especialidad->save();

        // Asignar usuarios a la especialidad
        $especialidad->usuarios()->attach($request->idUsuario);
        
        // Recalcular el avance total de todas las especialidades

        return redirect()->route('especialidad.index')->with('message', 'Especialidad creada correctamente.');
    }

    /**public function show($id)
    {
        $especialidades = Especialidad::with(['fases','subfases'])->findOrFail($id);
        return view('especialidad.show', compact('especialidades'));
        //$especialidades = Especialidad::with(['fase,subfases'])->findOrFail($id);
        //return view('especialidad.show', compact('especialidades'));
    }**/
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idUsuario' => 'array',
            'idUsuario' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
        ]);

        $especialidades = Especialidad::findOrFail($id);
        $especialidades->nombreEspecialidad = $request->nombreEspecialidad;
        $especialidades->porcentajeAvanceEspecialidad = $request->porcentajeAvanceEspecialidad;
        $especialidades->save();

        $especialidades->usuarios()->sync($request->idUsuario);

        // Recalcular el avance total de todas las especialidades
        //$this->recalcularAvanceTotalEspecialidad();

        return redirect()->route('especialidad.index')->with('message', 'Especialidad actualizada correctamente.');
    }

    public function destroy($id)
    {
        $especialidades = Especialidad::findOrFail($id);
        $especialidades->delete();
        // Recalcular el avance total de todas las especialidades
        //$this->recalcularAvanceTotalEspecialidad();

        return redirect()->route('especialidad.index')->with('message', 'Especialidad eliminado correctamente.');
    }
    private function recalcularAvanceTotalEspecialidad()
    {
        $especialidades = Especialidad::all();
        foreach ($especialidades as $especialidad) {
            $fases = Fase::where('idEspecialidad', $especialidad->idEspecialidad)->get();
            $sumAvanceTotalFase = $fases->sum('avanceTotalFase');
            $especialidad->avanceTotalEspecialidad = ($especialidad->porcentajeAvanceEspecialidad * $sumAvanceTotalFase) / 100;
            $especialidad->save();
        }
    }
    public function pdf(){
        $especialidades = Especialidad::all();
        $fases = Fase::all();
       $subfases = SubFase::all();
        $inversiones = Inversion::all();
        $usuarios = User::all(); // Carga todas las inversiones
        $pdf = Pdf::loadView('especialidad.pdf', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases'));
        return $pdf->stream();
        //return view('especialidad.pdf', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases'));
    }

}

