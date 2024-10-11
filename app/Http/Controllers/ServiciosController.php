<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use App\Models\Servicio;
use App\Models\User;
use Carbon\Carbon;
use App\Models\AsignacionProfesional;
use Auth;
class ServiciosController extends Controller
{
    //
    public function index(Request $request)
    {
        $servicios = Servicio::all();
        $inversiones = Inversion::all();
        $usuarios = User::all();
        
        return view('servicios.index', compact('servicios','inversiones','usuarios')); // Asegúrate de que la ruta del archivo Blade sea correcta
    }
    public function store(Request $request){
        // Validaciones
          // Validaciones
    $request->validate([
        'nombre_servicio' => 'required|string|max:255',
        'meta' => 'required|string|max:255',
        'siaf' => 'nullable|string|max:255',
        'f_presentacion_req_inicio' => 'nullable|date',
        'f_presentacion_req_fin' => 'nullable|date|after_or_equal:f_presentacion_req_inicio',

        'f_designacion_cotizador_inicio' => 'nullable|date',
        'f_designacion_cotizador_fin' => 'nullable|date|after_or_equal:f_designacion_cotizador_inicio',

        'f_estudio_mercado_inicio' => 'nullable|date',
        'f_estudio_mercado_fin' => 'nullable|date|after_or_equal:f_estudio_mercado_inicio',

        'f_cuadro_comparativo_inicio' => 'nullable|date',
        'f_cuadro_comparativo_fin' => 'nullable|date|after_or_equal:f_cuadro_comparativo_inicio',

        'f_elaboracion_certificado_inicio' => 'nullable|date',
        'f_elaboracion_certificado_fin' => 'nullable|date|after_or_equal:f_elaboracion_certificado_inicio',

        'f_orden_servicio_inicio' => 'nullable|date',
        'f_orden_servicio_fin' => 'nullable|date|after_or_equal:f_orden_servicio_inicio',

        'f_notificacion_inicio' => 'nullable|date',
        'f_notificacion_fin' => 'nullable|date|after_or_equal:f_notificacion_inicio',

        'f_retorno_SGEP_inicio' => 'nullable|date',
        'f_retorno_SGEP_fin' => 'nullable|date|after_or_equal:f_retorno_SGEP_inicio',
        
        'f_mesa_partes_inicio'  => 'nullable|date',
        'fecha_derivar_proyectista'  => 'nullable|date',
        'fecha_informe_conformidad'  => 'nullable|date',
        'fecha_SGEP_administracion'  => 'nullable|date',
        'envio' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string|max:1024',
        'conformidad' => 'nullable|string|max:255',
        'idInversion' => 'nullable|exists:inversion,idInversion',
        'idUsuario' => 'nullable|exists:users,idUsuario',
        
    ],[
        'nombre_servicio.nullable' => 'El campo del nombre es Obligatorio',
        'f_presentacion_req_fin.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_estudio_mercado_fin.after_or_equal' => 'La fecha final del estudio de mercado debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_elaboracion_certificado_fin.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_servicio_fin.after_or_equal' => 'La fecha final de orden de servicio debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'f_retorno_SGEP_fin.after_or_equal' => 'La fecha final de retorno SGEP debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Crear un nuevo servicio en la base de datos
    $servicio = new Servicio();
    $servicio->nombre_servicio = $request->nombre_servicio;
    $servicio->meta = $request->meta;
    $servicio->siaf = $request->siaf;
    ///
    $servicio->f_presentacion_req_inicio = $request->f_presentacion_req_inicio;
    $servicio->f_presentacion_req_fin = $request->f_presentacion_req_fin;
    $servicio->presentacion_dias = $request->presentacion_dias;
    ///
    $servicio->f_designacion_cotizador_inicio = $request->f_designacion_cotizador_inicio;
    $servicio->f_designacion_cotizador_fin = $request->f_designacion_cotizador_fin;
    $servicio->designacion_dias = $request->designacion_dias;
    ///
    $servicio->f_estudio_mercado_inicio = $request->f_estudio_mercado_inicio;
    $servicio->f_estudio_mercado_fin = $request->f_estudio_mercado_fin;
    $servicio->estudiomercado_dias= $request->estudiomercado_dias;
    ///
    $servicio->f_cuadro_comparativo_inicio = $request->f_cuadro_comparativo_inicio;
    $servicio->f_cuadro_comparativo_fin = $request->f_cuadro_comparativo_fin;
    $servicio->cuadro_comparativo_dias = $request->cuadro_comparativo_dias;
    
    ///
    $servicio->f_elaboracion_certificado_inicio = $request->f_elaboracion_certificado_inicio;
    $servicio->f_elaboracion_certificado_fin = $request->f_elaboracion_certificado_fin;
    $servicio->elaboracion_certificado_dias = $request->elaboracion_certificado_dias;
    ///
    $servicio->f_orden_servicio_inicio = $request->f_orden_servicio_inicio;
    $servicio->f_orden_servicio_fin = $request->f_orden_servicio_fin;
    $servicio->orden_servicio_dias = $request->orden_servicio_dias;
    //
    $servicio->f_notificacion_inicio = $request->f_notificacion_inicio;
    $servicio->f_notificacion_fin = $request->f_notificacion_fin;
    $servicio->notificacion_dias = $request->notificacion_dias;
    ///
    $servicio->f_retorno_SGEP_inicio = $request->f_retorno_SGEP_inicio;
    $servicio->f_retorno_SGEP_fin = $request->f_retorno_SGEP_fin;
    $servicio->retorno_SGEP_dias = $request->retorno_SGEP_dias;
    //
    $servicio->fecha_plazo_ejecucion = $request->fecha_plazo_ejecucion;
    $servicio->plazo_ejecucion_dias = $request->plazo_ejecucion_dias;
    //
    $servicio->ampliacion_plazo_dias = $request->ampliacion_plazo_dias;
    $servicio->fecha_ampliacion_plazo = $request->fecha_ampliacion_plazo;
    //
    $servicio->observaciones = $request->observaciones;
    //
    $servicio->fecha_carta_desestimiento = $request->fecha_carta_desestimiento;
    //
    $servicio->f_mesa_partes_inicio= $request->f_mesa_partes_inicio;
    $servicio->fecha_derivar_proyectista = $request->fecha_derivar_proyectista;
    $servicio->fecha_informe_conformidad = $request->fecha_informe_conformidad;
    $servicio->fecha_SGEP_administracion = $request->fecha_SGEP_administracion;
    
   
    
    $servicio->conformidad = $request->conformidad;
   
    $servicio->fecha_SGASA_penalidad = $request->fecha_SGASA_penalidad;

    $servicio->envio = $request->envio;
    
    $servicio->idInversion = $request->idInversion;
    $servicio->idUsuario = $request->idUsuario;
    $servicio->save();
   
    // Redireccionar con un mensaje de éxito
    return redirect()->route('servicios.index')->with('message', 'Servicio agregado correctamente.');
    }

   
    public function update(Request $request, $id)
    {
    // Validaciones
    $request->validate([
        'nombre_servicio' => 'required|string|max:255',
        'meta' => 'required|string|max:255',
        'siaf' => 'nullable|string|max:255',
        'f_presentacion_req_inicio' => 'nullable|date',
        'f_presentacion_req_fin' => 'nullable|date|after_or_equal:f_presentacion_req_inicio',

        'f_designacion_cotizador_inicio' => 'nullable|date',
        'f_designacion_cotizador_fin' => 'nullable|date|after_or_equal:f_designacion_cotizador_inicio',

        'f_estudio_mercado_inicio' => 'nullable|date',
        'f_estudio_mercado_fin' => 'nullable|date|after_or_equal:f_estudio_mercado_inicio',

        'f_cuadro_comparativo_inicio' => 'nullable|date',
        'f_cuadro_comparativo_fin' => 'nullable|date|after_or_equal:f_cuadro_comparativo_inicio',

        'f_elaboracion_certificado_inicio' => 'nullable|date',
        'f_elaboracion_certificado_fin' => 'nullable|date|after_or_equal:f_elaboracion_certificado_inicio',

        'f_orden_servicio_inicio' => 'nullable|date',
        'f_orden_servicio_fin' => 'nullable|date|after_or_equal:f_orden_servicio_inicio',

        'f_notificacion_inicio' => 'nullable|date',
        'f_notificacion_fin' => 'nullable|date|after_or_equal:f_notificacion_inicio',

        'f_retorno_SGEP_inicio' => 'nullable|date',
        'f_retorno_SGEP_fin' => 'nullable|date|after_or_equal:f_retorno_SGEP_inicio',
        
        'f_mesa_partes_inicio'  => 'nullable|date',
        'fecha_derivar_proyectista'  => 'nullable|date',
        'fecha_informe_conformidad'  => 'nullable|date',
        'fecha_SGEP_administracion'  => 'nullable|date',
        'envio' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string|max:1024',
        'conformidad' => 'nullable|string|max:255',
        'idInversion' => 'nullable|exists:inversion,idInversion',
        'idUsuario' => 'nullable|exists:users,idUsuario',
    ], [
        'f_presentacion_req_fin.after_or_equal' => 'La fecha final de presentación debe ser posterior o igual a la fecha de inicio.',
        'f_designacion_cotizador_fin.after_or_equal' => 'La fecha final de designación debe ser posterior o igual a la fecha de inicio.',
        'f_estudio_mercado_fin.after_or_equal' => 'La fecha final del estudio de mercado debe ser posterior o igual a la fecha de inicio.',
        'f_cuadro_comparativo_fin.after_or_equal' => 'La fecha final del cuadro comparativo debe ser posterior o igual a la fecha de inicio.',
        'f_elaboracion_certificado_fin.after_or_equal' => 'La fecha final de elaboración del certificado debe ser posterior o igual a la fecha de inicio.',
        'f_orden_servicio_fin.after_or_equal' => 'La fecha final de orden de servicio debe ser posterior o igual a la fecha de inicio.',
        'f_notificacion_fin.after_or_equal' => 'La fecha final de notificación debe ser posterior o igual a la fecha de inicio.',
        'f_retorno_SGEP_fin.after_or_equal' => 'La fecha final de retorno SGEP debe ser posterior o igual a la fecha de inicio.',
    ]);

    // Recuperar el servicio existente
    $servicio = Servicio::findOrFail($id);

    // Actualizar los campos
    $servicio->nombre_servicio = $request->nombre_servicio;
    $servicio->meta = $request->meta;
    $servicio->siaf = $request->siaf;
    $servicio->f_presentacion_req_inicio = $request->f_presentacion_req_inicio;
    $servicio->f_presentacion_req_fin = $request->f_presentacion_req_fin;
    $servicio->presentacion_dias = $request->presentacion_dias;
    $servicio->f_designacion_cotizador_inicio = $request->f_designacion_cotizador_inicio;
    $servicio->f_designacion_cotizador_fin = $request->f_designacion_cotizador_fin;
    $servicio->designacion_dias = $request->designacion_dias;
    $servicio->f_estudio_mercado_inicio = $request->f_estudio_mercado_inicio;
    $servicio->f_estudio_mercado_fin = $request->f_estudio_mercado_fin;
    $servicio->estudiomercado_dias = $request->estudiomercado_dias;
    $servicio->f_cuadro_comparativo_inicio = $request->f_cuadro_comparativo_inicio;
    $servicio->f_cuadro_comparativo_fin = $request->f_cuadro_comparativo_fin;
    $servicio->cuadro_comparativo_dias = $request->cuadro_comparativo_dias;
    $servicio->f_elaboracion_certificado_inicio = $request->f_elaboracion_certificado_inicio;
    $servicio->f_elaboracion_certificado_fin = $request->f_elaboracion_certificado_fin;
    $servicio->elaboracion_certificado_dias = $request->elaboracion_certificado_dias;
    $servicio->f_orden_servicio_inicio = $request->f_orden_servicio_inicio;
    $servicio->f_orden_servicio_fin = $request->f_orden_servicio_fin;
    $servicio->orden_servicio_dias = $request->orden_servicio_dias;
    $servicio->f_notificacion_inicio = $request->f_notificacion_inicio;
    $servicio->f_notificacion_fin = $request->f_notificacion_fin;
    $servicio->notificacion_dias = $request->notificacion_dias;
    $servicio->f_retorno_SGEP_inicio = $request->f_retorno_SGEP_inicio;
    $servicio->f_retorno_SGEP_fin = $request->f_retorno_SGEP_fin;
    $servicio->retorno_SGEP_dias = $request->retorno_SGEP_dias;
    $servicio->fecha_plazo_ejecucion = $request->fecha_plazo_ejecucion;
    $servicio->plazo_ejecucion_dias = $request->plazo_ejecucion_dias;
    $servicio->ampliacion_plazo_dias = $request->ampliacion_plazo_dias;
    $servicio->fecha_ampliacion_plazo = $request->fecha_ampliacion_plazo;
    $servicio->observaciones = $request->observaciones;
    $servicio->fecha_carta_desestimiento = $request->fecha_carta_desestimiento;
    $servicio->f_mesa_partes_inicio = $request->f_mesa_partes_inicio;
    $servicio->fecha_derivar_proyectista = $request->fecha_derivar_proyectista;
    $servicio->fecha_informe_conformidad = $request->fecha_informe_conformidad;
    $servicio->fecha_SGEP_administracion = $request->fecha_SGEP_administracion;
    $servicio->conformidad = $request->conformidad; // Manejar la conformidad
    $servicio->fecha_SGASA_penalidad = $request->fecha_SGASA_penalidad;
    $servicio->envio = $request->envio;
    $servicio->idInversion = $request->idInversion;
    $servicio->idUsuario = $request->idUsuario;

    // Guardar los cambios
    $servicio->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('servicios.index')->with('message', 'Servicio actualizado correctamente.');
    }
    public function destroy($id){
    // Buscamos la especialidad
    $servicio = Servicio::findOrFail($id);

    // Eliminamos la especialidad
    $servicio->delete();

    return redirect()->route('servicios.index')->with('message', 'Servicio ' . $servicio->nombre_servicio . ' eliminado correctamente.');
    }

    public function getUsuariosPorInversiones($idInversion)
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
