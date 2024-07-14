<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\SubFase;
use App\Models\Especialidad;

class FaseController extends Controller
{
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
        $this->recalcularPorcentajeAvanceFase();
        $this->recalcularAvanceTotalFase();
        //$especialidadController = new EspecialidadController();
        //$especialidadController->recalcularAvanceTotalEspecialidad($fase->idEspecialidad);
        //return redirect()->back()->with('success', 'Subfases creadas y actualizadas con éxito');
        return redirect()->route('especialidad.index')->with('message', 'Actividad creada correctamente.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreFase' => 'required|string|max:255',
            //'idEspecialidad' => 'required|exists:especialidad,idEspecialidad',
        ], [
            'nombreFase.required' => 'El campo Nombre Segmento es obligatorio.',
            //'idEspecialidad.required' => 'El campo Inversión es obligatorio.',
            //'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        $fase = Fase::findOrFail($id);
        $fase->nombreFase = $request->nombreFase;
        //$fase->idEspecialidad = $request->idEspecialidad;
        $fase->save();

        // Recalcular el avance total de todas las fases
        $this->recalcularPorcentajeAvanceFase();
        
       // $especialidadController = new EspecialidadController();
        //$especialidadController->recalcularAvanceTotalEspecialidad($fase->idEspecialidad);

        return redirect()->route('especialidad.index')->with('message', 'Elemento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $fase = Fase::findOrFail($id);
        $fase->delete();

        // Recalcular el avance total de todas las fases
        $this->recalcularPorcentajeAvanceFase();
        $this->recalcularAvanceTotalFase();

        return redirect()->route('especialidad.index')->with('message', 'Elemento eliminado correctamente.');
    }

    private function recalcularPorcentajeAvanceFase()
    {
        // Obtener todas las fases agrupadas por idEspecialidad
        $fasesPorEspecialidad = Fase::all()->groupBy('idEspecialidad');

        foreach ($fasesPorEspecialidad as $idEspecialidad => $fases) {
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
    private function recalcularAvanceTotalFase()
    {
        $fases = Fase::all();
        foreach ($fases as $fase) {
            $subfases = SubFase::where('idFase', $fase->idFase)->get();
            $totalAvanceRealTotalSubFase = $subfases->sum('avanceRealTotalSubFase');
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
            //$sumAvanceTotalFase = $fases->sum('avanceTotalFase');
            //$especialidad->avanceTotalEspecialidad = ($especialidad->porcentajeAvanceEspecialidad * $sumAvanceTotalFase) / 100;
           // $especialidad->save();
        }
    }

}
   // Verificar que la fase se esté obteniendo y actualizando correctamente