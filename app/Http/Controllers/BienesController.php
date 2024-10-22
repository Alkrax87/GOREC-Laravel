<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Bien;
use App\Models\User;
use Carbon\Carbon;
use App\Models\AsignacionProfesional;
use Auth;
class BienesController extends Controller
{
    public function index(Request $request)
    {
        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');
        }

        $notificaciones = [];

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        $bienes = Bien::all();
        $inversiones = Inversion::all();
        $usuarios = User::all();
        
        return view('bienes.index', compact('bienes','inversiones','usuarios','notificaciones')); // Asegúrate de que la ruta del archivo Blade sea correcta
    }
    public function store(Request $request){
        
          // Validaciones
    $request->validate([
        'nombre_bienes' => 'required|string|max:255',
        'meta_bienes' => 'required|string|max:255',
        'siaf_bienes' => 'nullable|string|max:255',
        'f_presentacion_req_inicio_bs' => 'nullable|date',
        'f_presentacion_req_fin_bs' => 'nullable|date|after_or_equal:f_presentacion_req_inicio_bs',
        
        'f_designacion_cotizador_inicio_bs' => 'nullable|date',
        'f_designacion_cotizador_fin_bs' => 'nullable|date|after_or_equal:f_designacion_cotizador_inicio_bs',
        
        'f_cotizacion_inicio_bs' => 'nullable|date',
        'f_cotizacion_fin_bs' => 'nullable|date|after_or_equal:f_cotizacion_inicio_bs',

        'f_cuadro_comparativo_inicio_bs' => 'nullable|date',
        'f_cuadro_comparativo_fin_bs' => 'nullable|date|after_or_equal:f_cuadro_comparativo_inicio_bs',
        
        'f_numero_certificacion_inicio_bs' => 'nullable|date',
        'f_numero_certificacion_fin_bs' => 'nullable|date|after_or_equal:f_numero_certificacion_inicio_bs',
        
        'f_orden_compra_inicio_bs' => 'nullable|date',
        'f_orden_compra_fin_bs' => 'nullable|date|after_or_equal:f_orden_compra_inicio_bs',
        
        'f_notificacion_inicio_bs' => 'nullable|date',
        'f_notificacion_fin_bs' => 'nullable|date|after_or_equal:f_notificacion_inicio_bs',

        'fecha_patrimonizacion_inicio_bs' => 'nullable|date',
        'fecha_patrimonizacion_fin_bs' => 'nullable|date|after_or_equal:fecha_patrimonizacion_inicio_bs',

        'f_conformidad_proyectista_inicio_bs' => 'nullable|date',
        'f_conformidad_proyectista_fin_bs' => 'nullable|date|after_or_equal:f_conformidad_proyectista_inicio_bs',

        'plazo_ejecucion_dias_bs'  => 'nullable',
         'fecha_plazo_ejecucion_bs' => 'nullable|date',
         'observaciones_bs' => 'nullable|string|max:1024',
         'f_entrega_bien_inicio_bs' => 'nullable|date',
         'f_recepcion_bien_inicio_bs' => 'nullable|date',
         
         'conformidad_patrimonizacion_bs' => 'nullable|string|max:255',
         'conformidad_proyectista_bs' => 'nullable|string|max:255',
         'fecha_SGASA_penalidad_bs' => 'nullable|date',
         'envio_bs' => 'nullable|string|max:255',
        'idInversion' => 'nullable|exists:inversion,idInversion',
        'idUsuario' => 'nullable|exists:users,idUsuario',
        
    ],[
        'nombre_bienes.nullable' => 'El campo del nombre es Obligatorio',
        'f_presentacion_req_fin_bs.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin_bs.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_cotizacion_fin_bs.after_or_equal' => 'La fecha final de cotizacion debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin_bs.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_numero_certificacion_fin_bs.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_compra_fin_bs.after_or_equal' => 'La fecha final de orden de compra debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin_bs.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'fecha_patrimonizacion_fin_bs.after_or_equal' => 'La fecha final de patrimonizacion debe ser posterior o igual a la fecha de inicio.',
        'f_conformidad_proyectista_fin_bs.after_or_equal' => 'La fecha final de conformidad proyectista debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Crear un nuevo bien en la base de datos
    $bien = new Bien();
    $bien->nombre_bienes = $request->nombre_bienes;
    $bien->meta_bienes = $request->meta_bienes;
    $bien->siaf_bienes = $request->siaf_bienes;
    ///
    $bien->nombre_requerimientos_bs = $request->nombre_requerimientos_bs;
    $bien->f_presentacion_req_inicio_bs = $request->f_presentacion_req_inicio_bs;
    $bien->f_presentacion_req_fin_bs  = $request->f_presentacion_req_fin_bs;
    $bien->presentacion_dias_bs  = $request->presentacion_dias_bs;
    ///
    $bien->nombre_cotizador_bs = $request->nombre_cotizador_bs;
    $bien->f_designacion_cotizador_inicio_bs = $request->f_designacion_cotizador_inicio_bs;
    $bien->f_designacion_cotizador_fin_bs = $request->f_designacion_cotizador_fin_bs;
    $bien->designacion_dias_bs = $request->designacion_dias_bs;
    ///
    $bien->f_cotizacion_inicio_bs = $request->f_cotizacion_inicio_bs;
    $bien->f_cotizacion_fin_bs = $request->f_cotizacion_fin_bs;
    $bien->cotizacion_dias_bs = $request->cotizacion_dias_bs;
    ///
    $bien->f_cuadro_comparativo_inicio_bs = $request->f_cuadro_comparativo_inicio_bs;
    $bien->f_cuadro_comparativo_fin_bs = $request->f_cuadro_comparativo_fin_bs;
    $bien->cuadro_comparativo_dias_bs = $request->cuadro_comparativo_dias_bs;
    ///
    $bien->numero_certificacion_bs = $request->numero_certificacion_bs;
    $bien->f_numero_certificacion_inicio_bs = $request->f_numero_certificacion_inicio_bs;
    $bien->f_numero_certificacion_fin_bs = $request->f_numero_certificacion_fin_bs;
    $bien->numero_certificacion_dias_bs = $request->numero_certificacion_dias_bs;
    ////
    $bien->numero_orden_compra_bs = $request->numero_orden_compra_bs;
    $bien->f_orden_compra_inicio_bs = $request->f_orden_compra_inicio_bs;
    $bien->f_orden_compra_fin_bs= $request->f_orden_compra_fin_bs;
    $bien->orden_compra_dias_bs = $request->orden_compra_dias_bs;
    //
    $bien->f_notificacion_inicio_bs = $request->f_notificacion_inicio_bs;
    $bien->f_notificacion_fin_bs = $request->f_notificacion_fin_bs;
    $bien->notificacion_dias_bs = $request->notificacion_dias_bs;
    //
    $bien->fecha_plazo_ejecucion_bs = $request->fecha_plazo_ejecucion_bs;
    $bien->plazo_ejecucion_dias_bs = $request->plazo_ejecucion_dias_bs;
    //
    $bien->ampliacion_plazo_dias_bs = $request->ampliacion_plazo_dias_bs;
    $bien->fecha_ampliacion_plazo_bs = $request->fecha_ampliacion_plazo_bs;
    //
    $bien->observaciones_bs = $request->observaciones_bs;
    //
    $bien->fecha_carta_desestimiento_bs = $request->fecha_carta_desestimiento_bs;
    //
    $bien->f_entrega_bien_inicio_bs= $request->f_entrega_bien_inicio_bs;
    $bien->f_recepcion_bien_inicio_bs = $request->f_recepcion_bien_inicio_bs;
    ///
    $bien->fecha_patrimonizacion_inicio_bs = $request->fecha_patrimonizacion_inicio_bs;
    $bien->fecha_patrimonizacion_fin_bs = $request->fecha_patrimonizacion_fin_bs;
    $bien->patrimonizacion_dias_bs = $request->patrimonizacion_dias_bs;

    $bien->conformidad_patrimonizacion_bs = $request->conformidad_patrimonizacion_bs;
    ///
    $bien->conformidad_proyectista_bs = $request->conformidad_proyectista_bs;
    $bien->f_conformidad_proyectista_inicio_bs = $request->f_conformidad_proyectista_inicio_bs;
    $bien->f_conformidad_proyectista_fin_bs = $request->f_conformidad_proyectista_fin_bs;
    $bien->conformidad_proyectista_dias_bs = $request->conformidad_proyectista_dias_bs;
   
    $bien->fecha_SGASA_penalidad_bs = $request->fecha_SGASA_penalidad_bs;

    $bien->envio_bs = $request->envio_bs;
    
    $bien->penalidad_dias_bs = $request->penalidad_dias_bs;
    
    $bien->idInversion = $request->idInversion;
    $bien->idUsuario = $request->idUsuario;
    $bien->save();
   
    // Redireccionar con un mensaje de éxito
    return redirect()->route('bienes.index')->with('message', 'bien  <strong>' . $request->nombre_bienes . '</strong> agregado correctamente.');
    }

   
    public function update(Request $request, $id)
    {
    // Validaciones
    $request->validate([
        'nombre_bienes' => 'required|string|max:255',
        'meta_bienes' => 'required|string|max:255',
        'siaf_bienes' => 'nullable|string|max:255',
        'f_presentacion_req_inicio_bs' => 'nullable|date',
        'f_presentacion_req_fin_bs' => 'nullable|date|after_or_equal:f_presentacion_req_inicio_bs',
        
        'f_designacion_cotizador_inicio_bs' => 'nullable|date',
        'f_designacion_cotizador_fin_bs' => 'nullable|date|after_or_equal:f_designacion_cotizador_inicio_bs',
        
        'f_cotizacion_inicio_bs' => 'nullable|date',
        'f_cotizacion_fin_bs' => 'nullable|date|after_or_equal:f_cotizacion_inicio_bs',

        'f_cuadro_comparativo_inicio_bs' => 'nullable|date',
        'f_cuadro_comparativo_fin_bs' => 'nullable|date|after_or_equal:f_cuadro_comparativo_inicio_bs',
        
        'f_numero_certificacion_inicio_bs' => 'nullable|date',
        'f_numero_certificacion_fin_bs' => 'nullable|date|after_or_equal:f_numero_certificacion_inicio_bs',
        
        'f_orden_compra_inicio_bs' => 'nullable|date',
        'f_orden_compra_fin_bs' => 'nullable|date|after_or_equal:f_orden_compra_inicio_bs',
        
        'f_notificacion_inicio_bs' => 'nullable|date',
        'f_notificacion_fin_bs' => 'nullable|date|after_or_equal:f_notificacion_inicio_bs',

        'fecha_patrimonizacion_inicio_bs' => 'nullable|date',
        'fecha_patrimonizacion_fin_bs' => 'nullable|date|after_or_equal:fecha_patrimonizacion_inicio_bs',

        'f_conformidad_proyectista_inicio_bs' => 'nullable|date',
        'f_conformidad_proyectista_fin_bs' => 'nullable|date|after_or_equal:f_conformidad_proyectista_inicio_bs',

        'plazo_ejecucion_dias_bs'  => 'nullable',
         'fecha_plazo_ejecucion_bs' => 'nullable|date',
         'observaciones_bs' => 'nullable|string|max:1024',
         'f_entrega_bien_inicio_bs' => 'nullable|date',
         'f_recepcion_bien_inicio_bs' => 'nullable|date',
         
         'conformidad_patrimonizacion_bs' => 'nullable|string|max:255',
         'conformidad_proyectista_bs' => 'nullable|string|max:255',
         'fecha_SGASA_penalidad_bs' => 'nullable|date',
         'envio_bs' => 'nullable|string|max:255',
        'idInversion' => 'nullable|exists:inversion,idInversion',
        'idUsuario' => 'nullable|exists:users,idUsuario',
        
    ],[
        'nombre_bienes.nullable' => 'El campo del nombre es Obligatorio',
        'f_presentacion_req_fin_bs.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin_bs.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_cotizacion_fin_bs.after_or_equal' => 'La fecha final de cotizacion debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin_bs.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_numero_certificacion_fin_bs.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_compra_fin_bs.after_or_equal' => 'La fecha final de orden de compra debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin_bs.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'fecha_patrimonizacion_fin_bs.after_or_equal' => 'La fecha final de patrimonizacion debe ser posterior o igual a la fecha de inicio.',
        'f_conformidad_proyectista_fin_bs.after_or_equal' => 'La fecha final de conformidad proyectista debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Recuperar el bien existente
    $bien = Bien::findOrFail($id);

    // Actualizar los campos
    $bien->nombre_bienes = $request->nombre_bienes;
    $bien->meta_bienes = $request->meta_bienes;
    $bien->siaf_bienes = $request->siaf_bienes;
    ///
    $bien->nombre_requerimientos_bs = $request->nombre_requerimientos_bs;
    $bien->f_presentacion_req_inicio_bs = $request->f_presentacion_req_inicio_bs;
    $bien->f_presentacion_req_fin_bs  = $request->f_presentacion_req_fin_bs;
    $bien->presentacion_dias_bs  = $request->presentacion_dias_bs;
    ///
    $bien->nombre_cotizador_bs = $request->nombre_cotizador_bs;
    $bien->f_designacion_cotizador_inicio_bs = $request->f_designacion_cotizador_inicio_bs;
    $bien->f_designacion_cotizador_fin_bs = $request->f_designacion_cotizador_fin_bs;
    $bien->designacion_dias_bs = $request->designacion_dias_bs;
    ///
    $bien->f_cotizacion_inicio_bs = $request->f_cotizacion_inicio_bs;
    $bien->f_cotizacion_fin_bs = $request->f_cotizacion_fin_bs;
    $bien->cotizacion_dias_bs = $request->cotizacion_dias_bs;
    ///
    $bien->f_cuadro_comparativo_inicio_bs = $request->f_cuadro_comparativo_inicio_bs;
    $bien->f_cuadro_comparativo_fin_bs = $request->f_cuadro_comparativo_fin_bs;
    $bien->cuadro_comparativo_dias_bs = $request->cuadro_comparativo_dias_bs;
    ///
    $bien->numero_certificacion_bs = $request->numero_certificacion_bs;
    $bien->f_numero_certificacion_inicio_bs = $request->f_numero_certificacion_inicio_bs;
    $bien->f_numero_certificacion_fin_bs = $request->f_numero_certificacion_fin_bs;
    $bien->numero_certificacion_dias_bs = $request->numero_certificacion_dias_bs;
    ////
    $bien->numero_orden_compra_bs = $request->numero_orden_compra_bs;
    $bien->f_orden_compra_inicio_bs = $request->f_orden_compra_inicio_bs;
    $bien->f_orden_compra_fin_bs= $request->f_orden_compra_fin_bs;
    $bien->orden_compra_dias_bs = $request->orden_compra_dias_bs;
    //
    $bien->f_notificacion_inicio_bs = $request->f_notificacion_inicio_bs;
    $bien->f_notificacion_fin_bs = $request->f_notificacion_fin_bs;
    $bien->notificacion_dias_bs = $request->notificacion_dias_bs;
    //
    $bien->fecha_plazo_ejecucion_bs = $request->fecha_plazo_ejecucion_bs;
    $bien->plazo_ejecucion_dias_bs = $request->plazo_ejecucion_dias_bs;
    //
    $bien->ampliacion_plazo_dias_bs = $request->ampliacion_plazo_dias_bs;
    $bien->fecha_ampliacion_plazo_bs = $request->fecha_ampliacion_plazo_bs;
    //
    $bien->observaciones_bs = $request->observaciones_bs;
    //
    $bien->fecha_carta_desestimiento_bs = $request->fecha_carta_desestimiento_bs;
    //
    $bien->f_entrega_bien_inicio_bs= $request->f_entrega_bien_inicio_bs;
    $bien->f_recepcion_bien_inicio_bs = $request->f_recepcion_bien_inicio_bs;
    ///
    $bien->fecha_patrimonizacion_inicio_bs = $request->fecha_patrimonizacion_inicio_bs;
    $bien->fecha_patrimonizacion_fin_bs = $request->fecha_patrimonizacion_fin_bs;
    $bien->patrimonizacion_dias_bs = $request->patrimonizacion_dias_bs;

    $bien->conformidad_patrimonizacion_bs = $request->conformidad_patrimonizacion_bs;
    ///
    $bien->conformidad_proyectista_bs = $request->conformidad_proyectista_bs;
    $bien->f_conformidad_proyectista_inicio_bs = $request->f_conformidad_proyectista_inicio_bs;
    $bien->f_conformidad_proyectista_fin_bs = $request->f_conformidad_proyectista_fin_bs;
    $bien->conformidad_proyectista_dias_bs = $request->conformidad_proyectista_dias_bs;
   
    $bien->fecha_SGASA_penalidad_bs = $request->fecha_SGASA_penalidad_bs;

    $bien->envio_bs = $request->envio_bs;
    
    $bien->penalidad_dias_bs = $request->penalidad_dias_bs;
    
    $bien->idInversion = $request->idInversion;
    $bien->idUsuario = $request->idUsuario;

    // Guardar los cambios
    $bien->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('bienes.index')->with('message', 'bien  <strong>' . $request->nombre_bienes . '</strong> actualizado correctamente.');
    }
    public function destroy($id){
    // Buscamos la especialidad
    $bien = bien::findOrFail($id);

    // Eliminamos la especialidad
    $bien->delete();

    return redirect()->route('bienes.index')->with('message', 'bien <strong>' . $bien->nombre_bienes . '</strong>  eliminado correctamente.');
    }

    public function getUsuariosPorInversiones_bs($idInversion)
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
