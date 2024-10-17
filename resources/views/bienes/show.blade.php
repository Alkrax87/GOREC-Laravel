<div class="modal fade text-left" id="ModalShowBienes{{ $bien->idBienes }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-users-cog"></i> Detalles del bien</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 py-2">
            <b><i class="fas fa-tag"></i> Nombre bien:</b>&nbsp; {{ $bien->nombre_bienes }}
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-file-signature"></i> Meta:</b>&nbsp; {{ $bien->meta_bienes }}
          </div>
          <h5 class="mb-0">Presentacion de Requerimiento</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_presentacion_req_inicio_bs ? \Carbon\Carbon::parse($bien->f_presentacion_req_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp; {{ $bien->f_presentacion_req_fin_bs ? \Carbon\Carbon::parse($bien->f_presentacion_req_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->presentacion_dias_bs}}
          </div>
          <h5 class="mb-0">Designacion de Cotizador</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_designacion_cotizador_inicio_bs ? \Carbon\Carbon::parse($bien->f_designacion_cotizador_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp;  {{ $bien->f_designacion_cotizador_fin_bs ? \Carbon\Carbon::parse($bien->f_designacion_cotizador_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->designacion_dias_bs }}
          </div>
          <h5 class="mb-0">Estudio de Mercado</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_estudio_mercado_inicio_bs ? \Carbon\Carbon::parse($bien->f_estudio_mercado_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_estudio_mercado_fin_bs ? \Carbon\Carbon::parse($bien->f_estudio_mercado_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->estudiomercado_dias_bs }}
          </div>
          <h5 class="mb-0">Cuadro Comparativo</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_cuadro_comparativo_inicio_bs ? \Carbon\Carbon::parse($bien->f_cuadro_comparativo_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_cuadro_comparativo_fin_bs ? \Carbon\Carbon::parse($bien->f_cuadro_comparativo_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->cuadro_comparativo_dias_bs }}
          </div>
          <h5 class="mb-0">Elaboracion de Certificacion</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_elaboracion_certificado_inicio_bs ? \Carbon\Carbon::parse($bien->f_elaboracion_certificado_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_elaboracion_certificado_fin_bs ? \Carbon\Carbon::parse($bien->f_elaboracion_certificado_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->elaboracion_certificado_dias_bs}}
          </div>
          <h5 class="mb-0">Numero SIAF</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i>  Fecha inicio:</b>&nbsp; {{ $bien->f_numero_Siaf_inicio_bs ? \Carbon\Carbon::parse($bien->f_numero_Siaf_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_numero_Siaf_fin_bs ? \Carbon\Carbon::parse($bien->f_numero_Siaf_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->numero_Siaf_dias_bs }}
          </div>
          <h5 class="mb-0">Orden de Compra</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i>  Fecha inicio:</b>&nbsp; {{ $bien->f_orden_compra_inicio_bs ? \Carbon\Carbon::parse($bien->f_orden_compra_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_orden_compra_fin_bs ? \Carbon\Carbon::parse($bien->f_orden_compra_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->orden_compra_dias_bs }}
          </div>
          <h5 class="mb-0">Notificación</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_notificacion_inicio_bs ? \Carbon\Carbon::parse($bien->f_notificacion_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_notificacion_fin_bs ? \Carbon\Carbon::parse($bien->f_notificacion_fin_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->notificacion_dias_bs}}
          </div>
          <h5 class="mb-0">Plazo de Ejecución</h5>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->plazo_ejecucion_dias_bs }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_plazo_ejecucion_bs ? \Carbon\Carbon::parse($bien->fecha_plazo_ejecucion_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <h5 class="mb-0">Ampliación de Plazo</h5>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->ampliacion_plazo_dias_bs }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_ampliacion_plazo_bs ? \Carbon\Carbon::parse($bien->fecha_ampliacion_plazo_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          @if ($bien->observaciones_bs)
            <div class="col-12 py-2">
              <b><i class="fas fa-calendar-alt"></i> Observaciones:</b>&nbsp;
              <div class="col-12 mt-2">
                <div class="card text-white bg-dark mb-0">
                  <div class="card-body pb-0">
                    <div class="col-12">
                      <b><i class="fas fa-user-tie"></i> Profesional en:</b>
                      <ul class="pl-3">
                        {!! nl2br(e('- ' . str_replace("\n", "\n- ", $bien->observaciones_bs))) !!}
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if ($bien->fecha_carta_desestimiento_bs)
            <div class="col-12 py-2">
              <b><i class="fas fa-calendar-alt"></i> Carta de Desestimiento:</b>&nbsp; {{ $bien->fecha_carta_desestimiento_bs ? \Carbon\Carbon::parse($bien->fecha_carta_desestimiento_bs)->format('d/m/Y') : 'Por Definir' }}
            </div>
          @endif
          <div class="row">
            <div class="col-5 py-2">
              <b><i class="fas fa-calendar-alt"></i> Entrega Bien:</b>&nbsp; {{ $bien->f_entrega_bien_inicio_bs ? \Carbon\Carbon::parse($bien->f_entrega_bien_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
            </div>
            <div class="col-5 py-2">
              <b><i class="fas fa-calendar-alt"></i> Recepcion Bien:</b>&nbsp; {{ $bien->f_recepcion_bien_inicio_bs ? \Carbon\Carbon::parse($bien->f_recepcion_bien_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
            </div>
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha Patrimonizacion:</b>&nbsp; {{ $bien->fecha_patrimonizacion_bs ? \Carbon\Carbon::parse($bien->fecha_patrimonizacion_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-clipboard-check"></i> Conformidad Patrimonizacion:</b>&nbsp;
            @if ($bien->conformidad_patrimonizacion_bs === 'SI')
              <span class="badge badge-success" >SI</span>
            @elseif ($bien->conformidad_patrimonizacion_bs === 'NO')
              <span class="badge badge-danger">NO</span>
            @else
              <span class="badge badge-warning">EN ESPERA</span>
            @endif
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-clipboard-check"></i> Conformidad Proyectista:</b>&nbsp;
            @if ($bien->conformidad_proyectista_bs === 'COMPLETADO')
              <span class="badge badge-success" >COMPLETADO</span>
            @elseif ($bien->conformidad_proyectista_bs === 'CANCELADO')
              <span class="badge badge-danger">CANCELADO</span>
            @else
              <span class="badge badge-warning">EN PROCESO</span>
            @endif
          </div>
          <h5 class="mb-0">Envio a SGASA Penalidad</h5>
          <div class="col-6 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_SGASA_penalidad_bs ? \Carbon\Carbon::parse($bien->fecha_SGASA_penalidad_bs)->format('d/m/Y') : 'Por Definir' }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->penalidad_dias_bs }}
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-exclamation-triangle"></i> Penalidad:</b>&nbsp;
            @if ($bien->envio_bs === 'SI')
              <span class="badge badge-danger" >SI</span>
            @elseif ($bien->envio_bs === 'NO')
              <span class="badge badge-success">NO</span>
            @else
              <span class="badge badge-warning">EN ESPERA</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
