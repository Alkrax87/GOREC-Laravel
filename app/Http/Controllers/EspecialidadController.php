<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\User;
use App\Models\Especialidad;
use App\Models\EspecialidadUsers;
use App\Models\SubFase;
use App\Models\AsignacionProfesional;
use App\Models\Fase;
use App\Models\AvanceLog;
use Auth;

class EspecialidadController extends Controller
{
    // Función de carga de datos
    public function index(Request $request){
        // LLamamos a la funcion para calcular el avance total
        
        $this->recalcularAvanceTotalEspecialidad();

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
            
            $especialidades = Especialidad::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
            $inversionIds = $inversiones->pluck('idInversion');
            $especialidades = Especialidad::whereIn('idInversion', $inversionIds)->get();


            $especialidadIds = $especialidades->pluck('idEspecialidad');
            $especialidadesAdicionales = Especialidad::whereHas('usuarios', function ($query) use ($user) {
                $query->where('especialidad_users.idUsuario', $user->idUsuario);
            })->whereNotIn('idEspecialidad', $especialidadIds)->get();
            $especialidades = $especialidades->merge($especialidadesAdicionales);
        }

        // Cargamos los datos
        $fases = Fase::all();
        $subfases = SubFase::all();
        $logs = AvanceLog::all();
        $usuarios = User::whereNotNull('email')->where('idUsuario', '!=', 1)->get();

        return view('especialidad.index', compact('especialidades', 'inversiones', 'usuarios', 'fases', 'subfases','logs'));
    }
    // Función de agreagar un registro
    public function store(Request $request){
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idInversion' => 'required|exists:inversion,idInversion',
            'idUsuario' => 'array',
            'idUsuario.*' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Porcentaje Avance Especialidad es obligatorio.',
            'idInversion.required' => 'El campo Inversión es obligatorio.',
            'idInversion.exists' => 'La inversión seleccionada no existe.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
        ]);

        // Verificar la suma de los porcentajes en la inversión
        $porcentaje = $request->porcentajeAvanceEspecialidad;
        $totalPorcentaje = Especialidad::where('idInversion', $request->idInversion)
                                       ->sum('porcentajeAvanceEspecialidad');
        if ($totalPorcentaje + $porcentaje > 100) {
            return redirect()->back()->with('message', 'La suma de los porcentajes de las especialidades no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }

        // Crear un registro
        $especialidad = Especialidad::create([
            'nombreEspecialidad' => $request->nombreEspecialidad,
            'porcentajeAvanceEspecialidad' => $request->porcentajeAvanceEspecialidad,
            'avanceTotalEspecialidad' => 0,
            'idInversion' => $request->idInversion,
        ]);

        // Asignar usuarios a la especialidad
        $especialidad->usuarios()->attach($request->idUsuario);

        return redirect()->route('especialidad.index')->with('message', 'Especialidad ' . $request->nombreEspecialidad . ' creada correctamente.');
    }

    // Función editar un registro
    public function update(Request $request, $id){
        $request->validate([
            'nombreEspecialidad' => 'required|string|max:255',
            'porcentajeAvanceEspecialidad' => 'required|numeric',
            'idUsuario' => 'array|required',
            'idUsuario.*' => 'exists:users,idUsuario',
        ], [
            'nombreEspecialidad.required' => 'El campo Nombre Segmento es obligatorio.',
            'porcentajeAvanceEspecialidad.required' => 'El campo Porcentaje Avance Especialidad es obligatorio.',
            'idUsuario.required' => 'El campo Usuarios es obligatorio.',
            'idUsuario.*.exists' => 'Uno o más usuarios seleccionados no existen.',
        ]);

        // Encontrar la especialidad existente
        $especialidad = Especialidad::findOrFail($id);

        // Obtener el porcentaje de avance de la especialidad actual
        $nuevoPorcentaje = $request->porcentajeAvanceEspecialidad;
        $porcentajeAnterior = $especialidad->porcentajeAvanceEspecialidad;

        // Verificar la suma de los porcentajes en la inversión
         $totalPorcentaje = Especialidad::where('idInversion', $request->idInversion)
                                       ->sum('porcentajeAvanceEspecialidad');
        if ($totalPorcentaje + $nuevoPorcentaje - $porcentajeAnterior > 100) {
            return redirect()->back()->with('message', 'La suma de los porcentajes de las especialidades no puede superar 100. Por favor, ingrese un valor menor.')->withInput();
        }

        // Actualizar los atributos de la especialidad
        $especialidad->update([
            'nombreEspecialidad' => $request->nombreEspecialidad,
            'porcentajeAvanceEspecialidad' => $request->porcentajeAvanceEspecialidad,
            'avanceTotalEspecialidad' => 0,
        ]);

        // Sincronizar los usuarios asociados
        $especialidad->usuarios()->sync($request->idUsuario);

        return redirect()->route('especialidad.index')->with('message', 'Especialidad ' . $request->nombreEspecialidad . ' actualizada correctamente.');
    }
    // Función eliminar un registro
    public function destroy($id){
        // Buscamos la especialidad
        $especialidad = Especialidad::findOrFail($id);

        // Eliminamos la especialidad
        $especialidad->delete();

        return redirect()->route('especialidad.index')->with('message', 'Especialidad ' . $especialidad->nombreEspecialidad . ' eliminada correctamente.');
    }

    // Funcion para calcular el avance total de especialidad
    private function recalcularAvanceTotalEspecialidad(){
        // Buscamos la especialidad
        $especialidades = Especialidad::all();

        // Iteramos las especialidades para realizar los cálculos
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
    }
    public function getUsuariosPorInversion($idInversion)
    {
    // Obtener los IDs de los usuarios asignados a la inversión
    $jefes = AsignacionProfesional::where('idInversion', $idInversion)->pluck('idUsuario');

    // Obtener los usuarios con sus profesiones y especialidades
    $usuarios = User::with(['profesiones', 'especialidades'])
                    ->whereIn('idUsuario', $jefes)
                    ->get();

    // Devolver la información de los usuarios en formato JSON
    return response()->json($usuarios);
    }


}

