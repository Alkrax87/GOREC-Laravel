<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\Especialidad;

class FaseController extends Controller
{
    public function index(Request $request)
    {
        $fases = Fase::with(['especialidad'])->get();
        $especialidades = Especialidad::all(); // Carga todas las inversiones
        return view('especialidad.fase.index', compact('fases', 'especialidades'));
    }

    public function create()
    {
        $especialidades = Especialidad::all(); // Para cargar todas las inversiones
        return view('especialidad.fase.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreFase' => 'required|string|max:255',
            'idEspecialidad' => 'required|exists:especialidad,idEspecialidad',
        ], [
            'nombreFase.required' => 'El campo Nombre Segmento es obligatorio.',
            'idEspecialidad.required' => 'El campo Inversión es obligatorio.',
            'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        // Crear la nueva fase
        $fase = new Fase();
        $fase->nombreFase = $request->nombreFase;
        $fase->idEspecialidad = $request->idEspecialidad;
        $fase->avanceTotalFase = 0;
        $fase->porcentajeAvanceFase = 0; // Inicializar con 0 para evitar el error
       
        $fase->save();

        // Recalcular el avance total de todas las fases
        $this->recalcularAvanceTotalFase();

        return redirect()->route('especialidad.index')->with('message', 'Elemento creado correctamente.');
    }

    public function show($id)
    {
        $fases = Fase::with(['especialidad'])->findOrFail($id);
        return view('especialidad.fase.show', compact('fases'));
    }

    public function edit($id)
    {
        $fases = Fase::findOrFail($id);
        $especialidades = Especialidad::all(); // Para cargar todas las inversiones
        return view('especialidad.fase.edit', compact('fases', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreFase' => 'required|string|max:255',
            'idEspecialidad' => 'required|exists:especialidad,idEspecialidad',
        ], [
            'nombreFase.required' => 'El campo Nombre Segmento es obligatorio.',
            'idEspecialidad.required' => 'El campo Inversión es obligatorio.',
            'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        $fase = Fase::findOrFail($id);
        $fase->nombreFase = $request->nombreFase;
        $fase->idEspecialidad = $request->idEspecialidad;
        $fase->save();

        // Recalcular el avance total de todas las fases
        $this->recalcularAvanceTotalFase();

        return redirect()->route('fase.index')->with('message', 'Elemento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $fase = Fase::findOrFail($id);
        $fase->delete();

        // Recalcular el avance total de todas las fases
        $this->recalcularAvanceTotalFase();

        return redirect()->route('fase.index')->with('message', 'Elemento eliminado correctamente.');
    }

    private function recalcularAvanceTotalFase()
    {
        $fases = Fase::all();
        $totalFases = $fases->count();

        if ($totalFases > 0) {
            $porcentajeAvance = 100 / $totalFases;
            foreach ($fases as $fase) {
                $fase->porcentajeAvanceFase = $porcentajeAvance;
                // Aquí puedes asignar `avanceTotalFase` si tienes un cálculo específico
                $fase->save();
            }
        }
    }
}
