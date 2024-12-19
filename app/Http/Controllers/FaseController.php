<?php
namespace App\Http\Controllers;

use App\Models\AvanceLog;
use Auth;
use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\SubFase;
use App\Models\Inversion;
use App\Models\Especialidad;

class FaseController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();

        if ($user->isAdmin) {
            $especialidad = Especialidad::findOrFail($id);
            $fases = Fase::where('idEspecialidad', $id)->get();
            $subfases = SubFase::query()->orderBy('idSubfase', 'desc')->get();

            // Obtenermos los logs de las subfases
            $subfaseIds = $subfases->pluck('idSubfase');
            $logs = AvanceLog::whereIn('idSubfase', $subfaseIds)->get();

            return view('especialidad.fase.index', compact('especialidad', 'fases', 'subfases', 'logs'));
        } else {
            // obtener las invesiones donde el usuario esta asignado
            $inveriones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $especialidadFind = Especialidad::whereIn('idInversion', $inveriones->pluck('idInversion'))->get();
            if ($especialidadFind->count() > 0) {
                $especialidad = Especialidad::findOrFail($id);
                $fases = Fase::where('idEspecialidad', $id)->get();
                $subfases = SubFase::query()->orderBy('idSubfase', 'desc')->get();

                // Obtenermos los logs de las subfases
                $subfaseIds = $subfases->pluck('idSubfase');
                $logs = AvanceLog::whereIn('idSubfase', $subfaseIds)->get();

                return view('especialidad.fase.index', compact('especialidad', 'fases', 'subfases', 'logs'));
            } else {
                return redirect()->route('especialidad.index')->with('message', 'No tienes permisos para acceder a esta especialidad.');
            }
        }
    }

    // Funcion de agregar un registro
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'nombreFase' => 'required|string|max:255',
            'idEspecialidad' => 'required|exists:especialidad,idEspecialidad',
        ], [
            'nombreFase.required' => 'El nombre es obligatorio.',
            'idEspecialidad.required' => 'El campo idInversión es obligatorio.',
            'idEspecialidad.exists' => 'La inversión seleccionada no existe.',
        ]);

        // Creamos un registro
        Fase::create($request->all());

        // Calculamos el avance
        $this->recalcularPorcentajeAvanceFase();

        // Calculamos el avance total
        $this->recalcularAvanceTotalFase();

        return redirect()->route('especialidad.index')->with('message', 'La Fase ' . $request->nombreFase . ' ha sido creada correctamente.');
    }

    // Función editar un registro
    public function update(Request $request, $id)
    {
        // Validaciones
        $request->validate([
            'nombreFase' => 'required|string|max:255',
        ], [
            'nombreFase.required' => 'El nombre es obligatorio.',
        ]);

        // Buscamos la fase
        $fase = Fase::findOrFail($id);

        // Editamos la inversión
        $fase->update($request->all());

        // Calculamos el avance
        $this->recalcularPorcentajeAvanceFase();

        return redirect()->route('especialidad.index')->with('message', 'La Fase ' . $request->nombreFase . ' ha sido actualizada correctamente.');
    }

    public function destroy($id)
    {
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
    private function recalcularPorcentajeAvanceFase()
    {
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
    private function recalcularAvanceTotalFase()
    {
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
