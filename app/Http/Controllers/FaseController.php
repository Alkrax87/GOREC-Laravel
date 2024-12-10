<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\SubFase;
use App\Models\Especialidad;

class FaseController extends Controller
{
    // Funcion de agregar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'nombreFase' => 'required|string|max:255',
            'idEspecialidad' => 'required|exists:especialidad,idEspecialidad',
        ], [
            'nombreFase.required' => 'El nombre es obligatorio.',
            'idEspecialidad.required' => 'El campo idInversión es obligatorio.',
            'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        $porcentaje = $request->porcentajeAvanceFase;
        $totalPorcentaje = Fase::where('idEspecialidad', $request->idEspecialidad)
                                       ->sum('porcentajeAvanceFase');
        if ($totalPorcentaje + $porcentaje > 100) {
            return redirect()->back()->with('errorPorcentajefase', 'La suma de los porcentajes de las fases no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }
        
        $fase = Fase::create([
            'nombreFase' => $request->nombreFase,
            'porcentajeAvanceFase' => $request->porcentajeAvanceFase,
            'avanceTotalFase' => 0,
            'idEspecialidad' => $request->idEspecialidad,
        ]);
        // Creamos un registro
        //Fase::create($request->all());

        // Calculamos el avance
        //$this->recalcularPorcentajeAvanceFase();

        // Calculamos el avance total
        $this->recalcularAvanceTotalFase();

        return redirect()->route('especialidad.index')->with('message','La Fase ' . $request->nombreFase . ' ha sido creada correctamente.');
    }

    // Función editar un registro
    public function update(Request $request, $id){
        // Validaciones
        $request->validate([
            'nombreFase' => 'required|string|max:255',
        ], [
            'nombreFase.required' => 'El nombre es obligatorio.',
        ]);

        // Buscamos la fase
        $fase = Fase::findOrFail($id);

        // Obtener el porcentaje de avance de la especialidad actual
        $nuevoPorcentaje = $request->porcentajeAvanceFase;
        $porcentajeAnterior = $fase->porcentajeAvanceFase;

        // Verificar la suma de los porcentajes en la inversión
         $totalPorcentaje = Fase::where('idEspecialidad', $request->idEspecialidad)
                                       ->sum('porcentajeAvanceFase');
        if ($totalPorcentaje + $nuevoPorcentaje - $porcentajeAnterior > 100) {
            return redirect()->back()->with('errorPorcentajefase', 'La suma de los porcentajes de las fases no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }
        
        $fase->update([
            'nombreFase' => $request->nombreFase,
            'porcentajeAvanceFase' => $request->porcentajeAvanceFase,
            'avanceTotalFase' => 0,
        ]);
        // Editamos la inversión
        //$fase->update($request->all());
        $this->recalcularAvanceTotalFase();
        // Calculamos el avance
        //$this->recalcularPorcentajeAvanceFase();

        return redirect()->route('especialidad.index')->with('message', 'La Fase ' . $request->nombreFase . ' ha sido actualizada correctamente.');
    }

    public function destroy($id){
        // Buscamos la fase
        $fase = Fase::findOrFail($id);

        // Eliminamos la fase
        $fase->delete();

        // Calculamos el avance
        $this->recalcularPorcentajeAvanceFase();

        // Calculamos el avance total
        $this->recalcularAvanceTotalFase();

        return redirect()->route('especialidad.index')->with('message', 'La Fase ' . $fase->nombreFase . ' ha sido eliminado correctamente.');
    }

    // Funcion recalcular el porcentaje de Avance
    private function recalcularPorcentajeAvanceFase(){
        // Obtener todas las fases agrupadas por idEspecialidad
        $fasesPorEspecialidad = Fase::all()->groupBy('idEspecialidad');

        // Iteramos para ralizar los calculos
        foreach ($fasesPorEspecialidad as $idEspecialidad => $fases) {
            $totalFases = $fases->count();
            if ($totalFases > 0) {
                $porcentajeAvance = 100 / $totalFases;
                foreach ($fases as $fase) {
                    $fase->porcentajeAvanceFase = $porcentajeAvance;
                    $fase->save();
                }
            }
        }
    }

    // Funcion recalcular el porcentaje de avance total
    private function recalcularAvanceTotalFase(){
        // Buscamos las fases
        $fases = Fase::all();

        // Iteramos para realizar los calculos
        foreach ($fases as $fase) {
            $subfases = SubFase::where('idFase', $fase->idFase)->get();
            $totalAvanceRealTotalSubFase = $subfases->sum('avanceRealTotalSubFase');
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
        }
    }
}