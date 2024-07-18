<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubFase;
use App\Models\Fase;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class SubFaseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'idFase' =>'required|exists:fase,idFase',
            'subfases.*.nombreSubfase' => 'required|string',
            'subfases.*.fechaInicioSubfase' => 'required|date',
            'subfases.*.fechaFinalSubfase' => 'required|date',
            'subfases.*.avance_por_usuario_realSubFase' => 'required|integer',
        ]);

        $existingSubfases = SubFase::where('idFase', $request->idFase)->get();
        
        $subfases = [];
        $totalDias = 0;

        foreach ($request->subfases as $subfaseData) {
            $fechaInicio = Carbon::parse($subfaseData['fechaInicioSubfase']);
            $fechaFin = Carbon::parse($subfaseData['fechaFinalSubfase']);
            $cantidadDias = $this->countBusinessDays($fechaInicio, $fechaFin);
            $totalDias += $cantidadDias;
            
            $subfases[] = [
                'idFase' => $request->idFase,
                'nombreSubfase' => $subfaseData['nombreSubfase'],
                'fechaInicioSubfase' => $subfaseData['fechaInicioSubfase'],
                'fechaFinalSubfase' => $subfaseData['fechaFinalSubfase'],
                'cantidadDiasSubFase' => $cantidadDias,
                'porcentajeAvanceProgramadoSubFase' => 0,
                'avance_por_usuario_realSubFase' => $subfaseData['avance_por_usuario_realSubFase'],
                'avanceRealTotalSubFase' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($existingSubfases as $existingSubfase) {
            $subfases[] = [
                'idFase' => $existingSubfase->idFase,
                'nombreSubfase' => $existingSubfase->nombreSubfase,
                'fechaInicioSubfase' => $existingSubfase->fechaInicioSubfase,
                'fechaFinalSubfase' => $existingSubfase->fechaFinalSubfase,
                'cantidadDiasSubFase' => $existingSubfase->cantidadDiasSubFase,
                'porcentajeAvanceProgramadoSubFase' => 0,
                'avance_por_usuario_realSubFase' => $existingSubfase->avance_por_usuario_realSubFase,
                'avanceRealTotalSubFase' => 0,
                'created_at' => $existingSubfase->created_at,
                'updated_at' => now(),
            ];
            $totalDias += $existingSubfase->cantidadDiasSubFase;
        }

        $totalAvanceRealTotalSubFase = 0;
        foreach ($subfases as &$subfase) {
            $subfase['porcentajeAvanceProgramadoSubFase'] = ($subfase['cantidadDiasSubFase'] / $totalDias) * 100;
            $subfase['avanceRealTotalSubFase'] = ($subfase['porcentajeAvanceProgramadoSubFase'] * $subfase['avance_por_usuario_realSubFase']) / 100;
            $totalAvanceRealTotalSubFase += $subfase['avanceRealTotalSubFase'];
        }

        SubFase::where('idFase', $request->idFase)->delete();
        SubFase::insert($subfases);

        // Verificar que la fase se esté obteniendo y actualizando correctamente
        $fase = Fase::find($request->idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
            // Registro de depuración
            \Log::info('Fase actualizada: ', ['fase' => $fase]);
        } else {
            // Registro de depuración
            \Log::error('Fase no encontrada: ', ['idFase' => $request->idFase]);
        }
        
        return redirect()->back()->with('success', 'Subfases creadas y actualizadas con éxito');
    }

    private function countBusinessDays($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);
        $businessDays = 0;

        foreach ($period as $date) {
            if (!$date->isWeekend()) {
                $businessDays++;
            }
        }

        return $businessDays;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreSubfase' => 'required|string|max:255',
            'avance_por_usuario_realSubFase' => 'required|numeric|min:0|max:100',
        ],[
            'nombreSubfase.required' => 'El Nombre de la Actividad es obligatorio.',
            //'idEspecialidad.required' => 'El campo Inversión es obligatorio.',
            //'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        $subfase = SubFase::findOrFail($id);
        $subfase->nombreSubfase = $request->nombreSubfase;
        $subfase->avance_por_usuario_realSubFase = $request->avance_por_usuario_realSubFase;
        $subfase->avanceRealTotalSubFase = $subfase->porcentajeAvanceProgramadoSubFase * ($subfase->avance_por_usuario_realSubFase / 100);

        $subfase->save();

        $subfases = SubFase::where('idFase', $subfase->idFase)->get();
        $totalAvanceRealTotalSubFase = $subfases->sum('avanceRealTotalSubFase');

        $fase = Fase::find($subfase->idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
           $fase->save();
            // Registro de depuración
            \Log::info('Fase actualizada: ', ['fase' => $fase]);
        } else {
            // Registro de depuración
           \Log::error('Fase no encontrada: ', ['idFase' => $subfase->idFase]);
        }

        return redirect()->back()->with('success', 'Avance actualizado con éxito');
    }
    public function destroy($id)
    {
    // Encuentra la subfase a eliminar
        $subfase = SubFase::findOrFail($id);
        $idFase = $subfase->idFase;

    // Elimina la subfase
        $subfase->delete();

    // Obtén las subfases restantes
        $subfases = SubFase::where('idFase', $idFase)->get();

    // Recalcula el total de días y los porcentajes de avance programado y real
        $totalDias = 0;
        foreach ($subfases as $sf) {
            $totalDias += $sf->cantidadDiasSubFase;
        }

        $totalAvanceRealTotalSubFase = 0;
        foreach ($subfases as $sf) {
            $sf->porcentajeAvanceProgramadoSubFase = ($sf->cantidadDiasSubFase / $totalDias) * 100;
            $sf->avanceRealTotalSubFase = $sf->porcentajeAvanceProgramadoSubFase * ($sf->avance_por_usuario_realSubFase / 100);
            $totalAvanceRealTotalSubFase += $sf->avanceRealTotalSubFase;
            $sf->save();
        }

     // Actualiza la fase
        $fase = Fase::find($idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
            // Registro de depuración
            \Log::info('Fase actualizada después de eliminar subfase: ', ['fase' => $fase]);
        } else {
            // Registro de depuración
            \Log::error('Fase no encontrada después de eliminar subfase: ', ['idFase' => $idFase]);
        }

        return redirect()->back()->with('success', 'Subfase eliminada y avances recalculados con éxito');
    }

  
}



