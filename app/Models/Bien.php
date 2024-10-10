<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

     // Define la tabla asociada con el modelo
     protected $table = 'bienes';

     // Define la clave primaria
     protected $primaryKey = 'idBienes';
 
     // Desactiva los timestamps si no se usan
     public $timestamps = false;
 
     // Define los atributos asignables en masa
     protected $fillable = [
         'nombre_bienes',
         'meta_bienes',
         'f_presentacion_req_inicio_bs',
         'f_presentacion_req_fin_bs',
         'presentacion_dias_bs',
         'f_designacion_cotizador_inicio_bs',
         'f_designacion_cotizador_fin_bs',
         'designacion_dias_bs',
         'f_estudio_mercado_inicio_bs',
         'f_estudio_mercado_fin_bs',
         'estudiomercado_dias_bs',
         'f_cuadro_comparativo_inicio_bs',
         'f_cuadro_comparativo_fin_bs',
         'cuadro_comparativo_dias_bs',
         'f_elaboracion_certificado_inicio_bs',
         'f_elaboracion_certificado_fin_bs',
         'elaboracion_certificado_dias_bs',
         'f_numero_Siaf_inicio_bs',
         'f_numero_Siaf_fin_bs',
         'numero_Siaf_dias_bs',
         'f_orden_compra_inicio_bs',
         'f_orden_compra_fin_bs',
         'orden_compra_dias_bs',
         'f_notificacion_inicio_bs',
         'f_notificacion_fin_bs',
         'notificacion_dias_bs',
         'plazo_ejecucion_dias_bs',
         'fecha_plazo_ejecucion_bs',
         'ampliacion_plazo_dias_bs',
         'fecha_ampliacion_plazo_bs',
         'observaciones_bs',
         'fecha_carta_desestimiento_bs',
         'f_entrega_bien_inicio_bs',
         'f_recepcion_bien_inicio_bs',
         'fecha_patrimonizacion_bs',
         'conformidad_patrimonizacion_bs',
         'conformidad_proyectista_bs',
         'fecha_SGASA_penalidad_bs',
         'envio_bs',
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
