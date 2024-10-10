<div class="modal fade text-left" id="ModalShow{{ $servicio->idServicio }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-users-cog"></i> Detalles del Servicio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h3 class="text-center">SERVICIOS</h3>
                    <h5>Proyecto 1</h5>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Nombre Servicio:</b>&nbsp; {{ $servicio->nombre_servicio }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Meta:</b>&nbsp; {{ $servicio->meta }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Siaf:</b>&nbsp; {{ $servicio->siaf }}
                      </div>
                      <label for="">Presentacion de Requerimiento</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_presentacion_req_inicio}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin :</b>&nbsp; {{ $servicio->f_presentacion_req_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->presentacion_dias}}
                      </div>
                      <label for="">Designacion de Cotizador</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_designacion_cotizador_inicio }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin :</b>&nbsp; {{ $servicio->f_designacion_cotizador_fin}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->designacion_dias }}
                      </div>
                      <label for="">Estudio de Mercado</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_estudio_mercado_inicio}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_estudio_mercado_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->estudiomercado_dias }}
                      </div>
                      <label for="">Cuadro Comparativo</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_inicio }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->cuadro_comparativo_dias }}
                      </div>
                      <label for="">Elaboracion de Certificacion</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_elaboracion_certificado_inicio }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_elaboracion_certificado_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->elaboracion_certificado_dias}}
                      </div>
                      <label for="">Orden de servicio / Contrato</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i>  Fecha inicio:</b>&nbsp; {{ $servicio->f_orden_servicio_inicio}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_orden_servicio_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->orden_servicio_dias }}
                      </div>
                      <label for="">Notificación</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_notificacion_inicio}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_notificacion_fin}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->notificacion_dias}}
                      </div>
                      <label for="">Plazo de Ejecución</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->plazo_ejecucion_dias }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_plazo_ejecucion}}
                      </div>
                      <label for="">Ampliación de Plazo</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->ampliacion_plazo_dias }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_ampliacion_plazo }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Observaciones:</b>&nbsp;
                        {!! nl2br(e('* ' . str_replace("\n", "\n* ", $servicio->observaciones))) !!}
                    </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Carta de Desestimiento:</b>&nbsp; {{ $servicio->fecha_carta_desestimiento }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Entregable Mesa de Partes:</b>&nbsp; {{ \Carbon\Carbon::parse($servicio->f_mesa_partes_inicio)->format('d/m/Y') }}
                    </div>
                      <label for="">Retorno a SGEP (Sub Gerencia)</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_retorno_SGEP_inicio }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_retorno_SGEP_fin }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $servicio->retorno_SGEP_dias}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Deriva a Proyectista:</b>&nbsp; {{ $servicio->fecha_derivar_proyectista }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Informe de Conformidad (Proyectista):</b>&nbsp; {{ $servicio->fecha_informe_conformidad }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Deriva a la SGEP (Administración):</b>&nbsp; {{ $servicio->fecha_SGEP_administracion }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Conformidad:</b>&nbsp; 
                        @if ($servicio->conformidad === 'COMPLETADO')
                        <span class="badge badge-success" >COMPLETADO</span>
                        @elseif ($servicio->conformidad === 'CANCELADO')
                        <span class="badge badge-danger">CANCELADO</span>
                        @else
                           <span class="badge badge-warning">EN PROCESO</span> 
                        @endif
                    </div>
                      <label for="">Envio a SGASA Penalidad </label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_SGASA_penalidad}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i>Penalidad:</b>&nbsp; 
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
