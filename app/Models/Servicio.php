<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

     // Define la tabla asociada con el modelo
     protected $table = 'servicios';

     // Define la clave primaria
     protected $primaryKey = 'idServicio';
 
     // Desactiva los timestamps si no se usan
     public $timestamps = false;
 
     // Define los atributos asignables en masa
     protected $fillable = [
         'nombre_servicio',
         'meta',
         'siaf',
         'f_presentacion_req_inicio',
         'f_presentacion_req_fin',
         'presentacion_dias',
         'f_designacion_cotizador_inicio',
         'f_designacion_cotizador_fin',
         'designacion_dias',
         'f_estudio_mercado_inicio',
         'f_estudio_mercado_fin',
         'estudiomercado_dias',
         'f_cuadro_comparativo_inicio',
         'f_cuadro_comparativo_fin',
         'cuadro_comparativo_dias',
         'f_elaboracion_certificado_inicio',
         'f_elaboracion_certificado_fin',
         'elaboracion_certificado_dias',
         'f_orden_servicio_inicio',
         'f_orden_servicio_fin',
         'orden_servicio_dias',
         'f_notificacion_inicio',
         'f_notificacion_fin',
         'notificacion_dias',
         'plazo_ejecucion_dias',
         'fecha_plazo_ejecucion',
         'ampliacion_plazo_dias',
         'fecha_ampliacion_plazo',
         'observaciones',
         'fecha_carta_desestimiento',
         'f_mesa_partes_inicio',
         'f_retorno_SGEP_inicio',
         'f_retorno_SGEP_fin',
         'retorno_SGEP_dias',
         'fecha_derivar_proyectista',
         'fecha_informe_conformidad',
         'fecha_SGEP_administracion',
         'conformidad',
         'fecha_SGASA_penalidad',
         'envio',
         'idInversion',
         'idUsuario',
     ];
 
     // Define la relación con el modelo Inversion
     public function inversion()
     {
         return $this->belongsTo(Inversion::class, 'idInversion');
     }
     // Define la relación con el modelo EspecialidadUsers
     public function usuarios(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
