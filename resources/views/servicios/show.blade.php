<div class="modal fade text-left" id="ModalShow{{ $servicio->idServicio }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-wrench"></i> Detalles del Servicio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 py-2">
            <b><i class="fas fa-tag"></i> Nombre Servicio:</b>&nbsp; {{ $servicio->nombre_servicio }}
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-file-signature"></i> Meta:</b>&nbsp; {{ $servicio->meta }}
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-file-signature"></i> Siaf:</b>&nbsp; {{ $servicio->siaf }}
          </div>
          <h5 class="mb-0">Presentacion de Requerimiento</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_presentacion_req_inicio}}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp; {{ $servicio->f_presentacion_req_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->presentacion_dias}}
          </div>
          <h5 class="mb-0">Designacion de Cotizador</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_designacion_cotizador_inicio }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp; {{ $servicio->f_designacion_cotizador_fin}}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->designacion_dias }}
          </div>
          <h5 class="mb-0">Estudio de Mercado</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_estudio_mercado_inicio}}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_estudio_mercado_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->estudiomercado_dias }}
          </div>
          <h5 class="mb-0">Cuadro Comparativo</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_inicio }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->cuadro_comparativo_dias }}
          </div>
          <h5 class="mb-0">Elaboracion de Certificacion</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_elaboracion_certificado_inicio }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_elaboracion_certificado_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->elaboracion_certificado_dias}}
          </div>
          <h5 class="mb-0">Orden de servicio / Contrato</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i>  Fecha inicio:</b>&nbsp; {{ $servicio->f_orden_servicio_inicio}}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_orden_servicio_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->orden_servicio_dias }}
          </div>
          <h5 class="mb-0">Notificación</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_notificacion_inicio}}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_notificacion_fin}}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->notificacion_dias}}
          </div>
          <h5 class="mb-0">Plazo de Ejecución</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_plazo_ejecucion}}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->plazo_ejecucion_dias }}
          </div>
          <h5 class="mb-0">Ampliación de Plazo</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_ampliacion_plazo }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->ampliacion_plazo_dias }}
          </div>
          @if ($servicio->observaciones)
            <div class="col-12 py-2">
              <b><i class="fas fa-calendar-alt"></i> Observaciones:</b>&nbsp;
              <div class="col-12 mt-2">
                <div class="card text-white bg-dark mb-0">
                  <div class="card-body pb-0">
                    <div class="col-12">
                      <b><i class="fas fa-user-tie"></i> Profesional en:</b>
                      <ul class="pl-3">
                        {!! nl2br(e('- ' . str_replace("\n", "\n- ", $servicio->observaciones))) !!}
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if ($servicio->fecha_carta_desestimiento)
            <div class="col-12 py-2">
              <b><i class="fas fa-calendar-alt"></i> Carta de Desestimiento:</b>&nbsp; {{ $servicio->fecha_carta_desestimiento }}
            </div>
          @endif
          <div class="col-12 py-2">
            <b><i class="fas fa-calendar-alt"></i> Entregable Mesa de Partes:</b>&nbsp; {{ \Carbon\Carbon::parse($servicio->f_mesa_partes_inicio)->format('d/m/Y') }}
          </div>
          <h5 class="mb-0">Retorno a SGEP (Sub Gerencia)</h5>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_retorno_SGEP_inicio }}
          </div>
          <div class="col-5 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_retorno_SGEP_fin }}
          </div>
          <div class="col-2 py-2">
            <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->retorno_SGEP_dias}}
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-calendar-alt"></i> Deriva a Proyectista:</b>&nbsp; {{ $servicio->fecha_derivar_proyectista }}
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-calendar-alt"></i> Informe de Conformidad (Proyectista):</b>&nbsp; {{ $servicio->fecha_informe_conformidad }}
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-calendar-alt"></i> Deriva a la SGEP (Administración):</b>&nbsp; {{ $servicio->fecha_SGEP_administracion }}
          </div>
          <div class="col-12 py-2">
            <b><i class="fas fa-clipboard-check"></i> Conformidad:</b>&nbsp;
            @if ($servicio->conformidad === 'COMPLETADO')
              <span class="badge badge-success" >COMPLETADO</span>
            @elseif ($servicio->conformidad === 'CANCELADO')
              <span class="badge badge-danger">CANCELADO</span>
            @else
              <span class="badge badge-warning">EN PROCESO</span>
            @endif
          </div>
          <h5 class="mb-0">Envio a SGASA Penalidad </h5>
          <div class="col-6 py-2">
            <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_SGASA_penalidad}}
          </div>
          <div class="col-6 py-2">
            <b><i class="fas fa-exclamation-triangle"></i> Penalidad:</b>&nbsp;
            @if ($servicio->envio === 'SI')
              <span class="badge badge-danger" >SI</span>
            @elseif ($servicio->envio === 'NO')
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
