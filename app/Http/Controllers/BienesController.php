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
        $bienes = Bien::all();
        $inversiones = Inversion::all();
        $usuarios = User::all();
        
        return view('bienes.index', compact('bienes','inversiones','usuarios')); // Asegúrate de que la ruta del archivo Blade sea correcta
    }
    public function store(Request $request){
        
          // Validaciones
    $request->validate([
        'nombre_bien' => 'required|string|max:255',
        'meta_bien' => 'required|string|max:255',
        'f_presentacion_req_inicio_bs' => 'required|date',
        'f_presentacion_req_fin_bs' => 'required|date|after_or_equal:f_presentacion_req_inicio_bs',
        'f_designacion_cotizador_inicio_bs' => 'required|date',
        'f_designacion_cotizador_fin_bs' => 'required|date|after_or_equal:f_designacion_cotizador_inicio_bs',
        'f_estudio_mercado_inicio_bs' => 'required|date',
        'f_estudio_mercado_fin_bs' => 'required|date|after_or_equal:f_estudio_mercado_inicio_bs',
        'f_cuadro_comparativo_inicio_bs' => 'required|date',
        'f_cuadro_comparativo_fin_bs' => 'required|date|after_or_equal:f_cuadro_comparativo_inicio_bs',
        'f_elaboracion_certificado_inicio_bs' => 'required|date',
        'f_elaboracion_certificado_fin_bs' => 'required|date|after_or_equal:f_elaboracion_certificado_inicio_bs',
        'f_numero_Siaf_inicio_bs' => 'required|date',
        'f_numero_Siaf_fin_bs' => 'required|date|after_or_equal:f_numero_Siaf_inicio_bs',
        'f_orden_compra_inicio_bs' => 'required|date',
        'f_orden_compra_fin_bs' => 'required|date|after_or_equal:f_orden_compra_inicio_bs',
        'f_notificacion_inicio_bs' => 'required|date',
        'f_notificacion_fin_bs' => 'required|date|after_or_equal:f_notificacion_inicio_bs',
        'plazo_ejecucion_dias_bs'  => 'required',
         'fecha_plazo_ejecucion_bs' => 'required|date',
         'observaciones_bs' => 'nullable|string',
         'f_entrega_bien_inicio_bs' => 'required|date',
         'f_recepcion_bien_inicio_bs' => 'required|date',
         'fecha_patrimonizacion_bs' => 'required|date',
         'conformidad_patrimonizacion_bs' => 'nullable|string|max:255',
         'conformidad_proyectista_bs' => 'nullable|string|max:255',
         'fecha_SGASA_penalidad_bs' => 'nullable|date',
         'envio_bs' => 'nullable|string|max:255',
        'idInversion' => 'required|exists:inversion,idInversion',
        'idUsuario' => 'required|exists:users,idUsuario',
        
    ],[
        'nombre_bien.required' => 'El campo del nombre es Obligatorio',
        'f_presentacion_req_fin_bs.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin_bs.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_estudio_mercado_fin_bs.after_or_equal' => 'La fecha final del estudio de mercado debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin_bs.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_elaboracion_certificado_fin_bs.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_compra_fin_bs.after_or_equal' => 'La fecha final de orden de compra debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin_bs.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'f_numero_Siaf_fin_bs.after_or_equal' => 'La fecha final de retorno Siaf debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Crear un nuevo bien en la base de datos
    $bien = new Bien();
    $bien->nombre_bien = $request->nombre_bien;
    $bien->meta_bien = $request->meta_bien;
    ///
    $bien->f_presentacion_req_inicio_bs = $request->f_presentacion_req_inicio_bs;
    $bien->f_presentacion_req_fin_bs  = $request->f_presentacion_req_fin_bs;
    $bien->presentacion_dias_bs  = $request->presentacion_dias_bs;
    ///
    $bien->f_designacion_cotizador_inicio_bs = $request->f_designacion_cotizador_inicio_bs;
    $bien->f_designacion_cotizador_fin_bs = $request->f_designacion_cotizador_fin_bs;
    $bien->designacion_dias_bs = $request->designacion_dias_bs;
    ///
    $bien->f_estudio_mercado_inicio_bs = $request->f_estudio_mercado_inicio_bs;
    $bien->f_estudio_mercado_fin_bs = $request->f_estudio_mercado_fin_bs;
    $bien->estudiomercado_dias_bs = $request->estudiomercado_dias_bs;
    ///
    $bien->f_cuadro_comparativo_inicio_bs = $request->f_cuadro_comparativo_inicio_bs;
    $bien->f_cuadro_comparativo_fin_bs = $request->f_cuadro_comparativo_fin_bs;
    $bien->cuadro_comparativo_dias_bs = $request->cuadro_comparativo_dias_bs;
    
    ///
    $bien->f_elaboracion_certificado_inicio_bs = $request->f_elaboracion_certificado_inicio_bs;
    $bien->f_elaboracion_certificado_fin_bs = $request->f_elaboracion_certificado_fin_bs;
    $bien->elaboracion_certificado_dias_bs = $request->elaboracion_certificado_dias_bs;
    ///
    $bien->f_numero_Siaf_inicio_bs = $request->f_numero_Siaf_inicio_bs;
    $bien->f_numero_Siaf_fin_bs = $request->f_numero_Siaf_fin_bs;
    $bien->numero_Siaf_dias_bs = $request->numero_Siaf_dias_bs;
    ////
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
    $bien->fecha_patrimonizacion_bs = $request->fecha_patrimonizacion_bs;

    $bien->conformidad_patrimonizacion_bs = $request->conformidad_patrimonizacion_bs;
    $bien->conformidad_proyectista_bs = $request->conformidad_proyectista_bs;
   
    $bien->fecha_SGASA_penalidad_bs = $request->fecha_SGASA_penalidad_bs;

    $bien->envio_bs = $request->envio_bs;
    
    $bien->idInversion = $request->idInversion;
    $bien->idUsuario = $request->idUsuario;
    $bien->save();
   
    // Redireccionar con un mensaje de éxito
    return redirect()->route('bienes.index')->with('message', 'bien agregado correctamente.');
    }

   
    public function update(Request $request, $id)
    {
    // Validaciones
    $request->validate([
        'nombre_bien' => 'required|string|max:255',
        'meta_bien' => 'required|string|max:255',
        'f_presentacion_req_inicio_bs' => 'required|date',
        'f_presentacion_req_fin_bs' => 'required|date|after_or_equal:f_presentacion_req_inicio_bs',
        'f_designacion_cotizador_inicio_bs' => 'required|date',
        'f_designacion_cotizador_fin_bs' => 'required|date|after_or_equal:f_designacion_cotizador_inicio_bs',
        'f_estudio_mercado_inicio_bs' => 'required|date',
        'f_estudio_mercado_fin_bs' => 'required|date|after_or_equal:f_estudio_mercado_inicio_bs',
        'f_cuadro_comparativo_inicio_bs' => 'required|date',
        'f_cuadro_comparativo_fin_bs' => 'required|date|after_or_equal:f_cuadro_comparativo_inicio_bs',
        'f_elaboracion_certificado_inicio_bs' => 'required|date',
        'f_elaboracion_certificado_fin_bs' => 'required|date|after_or_equal:f_elaboracion_certificado_inicio_bs',
        'f_numero_Siaf_inicio_bs' => 'required|date',
        'f_numero_Siaf_fin_bs' => 'required|date|after_or_equal:f_numero_Siaf_inicio_bs',
        'f_orden_compra_inicio_bs' => 'required|date',
        'f_orden_compra_fin_bs' => 'required|date|after_or_equal:f_orden_compra_inicio_bs',
        'f_notificacion_inicio_bs' => 'required|date',
        'f_notificacion_fin_bs' => 'required|date|after_or_equal:f_notificacion_inicio_bs',
        'plazo_ejecucion_dias_bs'  => 'required',
         'fecha_plazo_ejecucion_bs' => 'required|date',
         'observaciones_bs' => 'nullable|string',
         'f_entrega_bien_inicio_bs' => 'required|date',
         'f_recepcion_bien_inicio_bs' => 'required|date',
         'fecha_patrimonizacion_bs' => 'required|date',
         'conformidad_patrimonizacion_bs' => 'nullable|string|max:255',
         'conformidad_proyectista_bs' => 'nullable|string|max:255',
         'fecha_SGASA_penalidad_bs' => 'nullable|date',
         'envio_bs' => 'nullable|string|max:255',
        'idInversion' => 'required|exists:inversion,idInversion',
        'idUsuario' => 'required|exists:users,idUsuario',
        
    ],[
        'nombre_bien.required' => 'El campo del nombre es Obligatorio',
        'f_presentacion_req_fin_bs.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin_bs.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_estudio_mercado_fin_bs.after_or_equal' => 'La fecha final del estudio de mercado debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin_bs.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_elaboracion_certificado_fin_bs.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_compra_fin_bs.after_or_equal' => 'La fecha final de orden de compra debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin_bs.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'f_numero_Siaf_fin_bs.after_or_equal' => 'La fecha final de retorno Siaf debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Recuperar el bien existente
    $bien = Bien::findOrFail($id);

    // Actualizar los campos
    $bien->nombre_bien = $request->nombre_bien;
    $bien->meta_bien = $request->meta_bien;
    ///
    $bien->f_presentacion_req_inicio_bs = $request->f_presentacion_req_inicio_bs;
    $bien->f_presentacion_req_fin_bs  = $request->f_presentacion_req_fin_bs;
    $bien->presentacion_dias_bs  = $request->presentacion_dias_bs;
    ///
    $bien->f_designacion_cotizador_inicio_bs = $request->f_designacion_cotizador_inicio_bs;
    $bien->f_designacion_cotizador_fin_bs = $request->f_designacion_cotizador_fin_bs;
    $bien->designacion_dias_bs = $request->designacion_dias_bs;
    ///
    $bien->f_estudio_mercado_inicio_bs = $request->f_estudio_mercado_inicio_bs;
    $bien->f_estudio_mercado_fin_bs = $request->f_estudio_mercado_fin_bs;
    $bien->estudiomercado_dias_bs = $request->estudiomercado_dias_bs;
    ///
    $bien->f_cuadro_comparativo_inicio_bs = $request->f_cuadro_comparativo_inicio_bs;
    $bien->f_cuadro_comparativo_fin_bs = $request->f_cuadro_comparativo_fin_bs;
    $bien->cuadro_comparativo_dias_bs = $request->cuadro_comparativo_dias_bs;
    
    ///
    $bien->f_elaboracion_certificado_inicio_bs = $request->f_elaboracion_certificado_inicio_bs;
    $bien->f_elaboracion_certificado_fin_bs = $request->f_elaboracion_certificado_fin_bs;
    $bien->elaboracion_certificado_dias_bs = $request->elaboracion_certificado_dias_bs;
    ///
    $bien->f_numero_Siaf_inicio_bs = $request->f_numero_Siaf_inicio_bs;
    $bien->f_numero_Siaf_fin_bs = $request->f_numero_Siaf_fin_bs;
    $bien->numero_Siaf_dias_bs = $request->numero_Siaf_dias_bs;
    ////
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
    $bien->fecha_patrimonizacion_bs = $request->fecha_patrimonizacion_bs;

    $bien->conformidad_patrimonizacion_bs = $request->conformidad_patrimonizacion_bs;
    $bien->conformidad_proyectista_bs = $request->conformidad_proyectista_bs;
   
    $bien->fecha_SGASA_penalidad_bs = $request->fecha_SGASA_penalidad_bs;

    $bien->envio_bs = $request->envio_bs;
    
    $bien->idInversion = $request->idInversion;
    $bien->idUsuario = $request->idUsuario;

    // Guardar los cambios
    $bien->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('biens.index')->with('message', 'bien actualizado correctamente.');
    }
    public function destroy($id){
    // Buscamos la especialidad
    $bien = bien::findOrFail($id);

    // Eliminamos la especialidad
    $bien->delete();

    return redirect()->route('biens.index')->with('message', 'bien ' . $bien->nombre_bien . ' eliminado correctamente.');
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
