<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubFase;
use App\Models\Fase;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\AvanceLog;

class SubFaseController extends Controller
{
    // Funcion de agregar un registro
    public function store(Request $request){
        // Validaciones
        $request->validate([
            'idFase' => 'required|exists:fase,idFase',
            'subfases.*.nombreSubfase' => 'required|string',
            'subfases.*.fechaInicioSubfase' => 'required|date',
            'subfases.*.fechaFinalSubfase' => 'required|date|after:subfases.*.fechaInicioSubfase',
            'subfases.*.avance_por_usuario_realSubFase' => 'required|integer',
        ], [
            'idFase.required' => 'El campo idFase es obligatorio.',
            'idFase.exists' => 'El idFase seleccionado no existe.',
            'subfases.*.nombreSubfase.required' => 'El nombre de la Sub Actividad es obligatorio.',
            'subfases.*.nombreSubfase.string' => 'El nombre de la Sub Actividad debe ser una cadena de texto.',
            'subfases.*.fechaInicioSubfase.required' => 'La fecha de inicio es obligatoria.',
            'subfases.*.fechaInicioSubfase.date' => 'La fecha de inicio debe ser una fecha válida.',
            'subfases.*.fechaFinalSubfase.required' => 'La fecha final es obligatoria.',
            'subfases.*.fechaFinalSubfase.date' => 'La fecha final debe ser una fecha válida.',
            'subfases.*.fechaFinalSubfase.after' => 'La fecha final debe ser una fecha posterior a la fecha de inicio.',
            'subfases.*.avance_por_usuario_realSubFase.required' => 'El avance es obligatorio.',
            'subfases.*.avance_por_usuario_realSubFase.integer' => 'El avance debe ser un número entero.',
        ]);

        // Buscamos si ya existen SubFases con el id de una Fase
        $existingSubfases = SubFase::where('idFase', $request->idFase)->get();

        // Definimos un array para almacenar las subfases
        $subfases = [];

        // Establecemos el valor inicial de dias en 0
        $totalDias = 0;

        // Iteramos en cada uno de los objetos recibidos en el request
        foreach ($request->subfases as $subfaseData) {
            // Instanciamos las fechas de inicio y final como clases de Carbon para la manipulación
            $fechaInicio = Carbon::parse($subfaseData['fechaInicioSubfase']);
            $fechaFin = Carbon::parse($subfaseData['fechaFinalSubfase']);

            // LLamamos a la funcion "countBusinessDays" para contar los dias
            $cantidadDias = $this->countBusinessDays($fechaInicio, $fechaFin);

            // Asignamos los dias entre la fecha inicio y final
            $totalDias += $cantidadDias;

            // Agregamos el objeto iterado al array de subfases
            $subfases[] = [
                'idFase' => $request->idFase,
                'nombreSubfase' => $subfaseData['nombreSubfase'],
                'fechaInicioSubfase' => $subfaseData['fechaInicioSubfase'],
                'fechaFinalSubfase' => $subfaseData['fechaFinalSubfase'],
                'cantidadDiasSubFase' => $cantidadDias,
                'porcentajeAvanceProgramadoSubFase' => 0,
                'avance_por_usuario_realSubFase' => $subfaseData['avance_por_usuario_realSubFase'],
                'avanceRealTotalSubFase' => 0,
            ];
        }

        // Iteramos entre las subfases existentes y lo agregamos al arreglo de subfases
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
            ];

            // Sumamos el total de dias
            $totalDias += $existingSubfase->cantidadDiasSubFase;
        }

        // Definimos el avance real total con un valor inicial de 0
        $totalAvanceRealTotalSubFase = 0;

        // Iteramos en cada subfase para calcular el % de avance
        foreach ($subfases as &$subfase) {
            $subfase['porcentajeAvanceProgramadoSubFase'] = ($subfase['cantidadDiasSubFase'] / $totalDias) * 100;
            $subfase['avanceRealTotalSubFase'] = ($subfase['porcentajeAvanceProgramadoSubFase'] * $subfase['avance_por_usuario_realSubFase']) / 100;
            $totalAvanceRealTotalSubFase += $subfase['avanceRealTotalSubFase'];
        }

        // Eliminamos las fases de la tabla
        SubFase::where('idFase', $request->idFase)->delete();

        // Creamos un nuevo registro
        SubFase::insert($subfases);

        // Verificar que la fase se esté obteniendo y actualizando correctamente
        $fase = Fase::find($request->idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
        }

        return redirect()->route('especialidad.index')->with('message', 'La Sub Actividades creadas con éxito');
    }

    // Funcion editar un registro
    public function update(Request $request, $id){
        // Validaciones
        $request->validate([
            'nombreSubfase' => 'required|string',
            'avance_por_usuario_realSubFase' => 'required|integer',
        ], [
            'nombreSubfase.required' => 'El nombre de la Sub Actividad es obligatorio.',
            'nombreSubfase.string' => 'El nombre de la Sub Actividad debe ser una cadena de texto.',
            'avance_por_usuario_realSubFase.required' => 'El avance es obligatorio.',
            'avance_por_usuario_realSubFase.integer' => 'El avance debe ser un número entero.',
        ]);

        // Buscamos la inversión
        $subfase = SubFase::findOrFail($id);

        // Guardamos el % de avance actual
        $currentAvanceSubfase = $subfase->avance_por_usuario_realSubFase;

        // Cambiamos los valores
        $subfase->nombreSubfase = $request->nombreSubfase;
        $subfase->avance_por_usuario_realSubFase = $request->avance_por_usuario_realSubFase;
        $subfase->avanceRealTotalSubFase = $subfase->porcentajeAvanceProgramadoSubFase * ($subfase->avance_por_usuario_realSubFase / 100);

        // Guardamos los cambios
        $subfase->save();

        // Comprobamos si el avance ha cambiado
        if ($request->avance_por_usuario_realSubFase != $currentAvanceSubfase) {
            AvanceLog::create([
                'avanceSubfaseOLD' => $currentAvanceSubfase,
                'avanceSubfaseNEW' => $request->avance_por_usuario_realSubFase,
                'fechaCambioAvance' => Carbon::now()->subHours(5),
                'idSubfase' => $id,
            ]);
        }

        // Obtenemos las subfases en base al id de la fase padre
        $subfases = SubFase::where('idFase', $subfase->idFase)->get();

        // Recalculamos el avance
        $totalAvanceRealTotalSubFase = $subfases->sum('avanceRealTotalSubFase');

        // Verificar que la fase se esté obteniendo y actualizando correctamente
        $fase = Fase::find($subfase->idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
        }

        return redirect()->route('especialidad.index')->with('message', 'La Sub Actividad ' . $request->nombreSubfase . ' actualizada con éxito');
    }

    public function destroy($id){
        // Buscamos la subfase
        $subfase = SubFase::findOrFail($id);

        // Elimina la subfase
        $subfase->delete();

        // Obtenemos el id de la fase
        $idFase = $subfase->idFase;

        // Obtenemos las subfases restantes
        $subfases = SubFase::where('idFase', $idFase)->get();

        // Recalcula el total de días
        $totalDias = 0;
        foreach ($subfases as $sf) {
            $totalDias += $sf->cantidadDiasSubFase;
        }

        // Recalculamos los porcentajes de avance programado y real
        $totalAvanceRealTotalSubFase = 0;
        foreach ($subfases as $sf) {
            $sf->porcentajeAvanceProgramadoSubFase = ($sf->cantidadDiasSubFase / $totalDias) * 100;
            $sf->avanceRealTotalSubFase = $sf->porcentajeAvanceProgramadoSubFase * ($sf->avance_por_usuario_realSubFase / 100);
            $totalAvanceRealTotalSubFase += $sf->avanceRealTotalSubFase;
            $sf->save();
        }

        // Actualizamos el avance la fase
        $fase = Fase::find($idFase);
        if ($fase) {
            $fase->avanceTotalFase = $totalAvanceRealTotalSubFase * ($fase->porcentajeAvanceFase / 100);
            $fase->save();
        }

        return redirect()->route('especialidad.index')->with('message', 'La Sub Actividad ' . $subfase->nombreSubfase . ' eliminada con éxito');
    }

    // Funcion de contar dias entre la fecha inicial y final
    private function countBusinessDays($startDate, $endDate){
        // Calculamos los dias entre 2 fechas
        $period = CarbonPeriod::create($startDate, $endDate);

        // Inicializamos los dias laborales en 0
        $businessDays = 0;

        // Iteramos entre los dias e incrementamos businessDays si no es fin de semana
        foreach ($period as $date) {
            if (!$date->isWeekend()) {
                $businessDays++;
            }
        }

        // Retornamos el numero de dias
        return $businessDays;
    }
}