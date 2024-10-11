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
                    <h3 class="text-center">bienS</h3>
                    <h5>Proyecto 1</h5>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Nombre bien:</b>&nbsp; {{ $bien->nombre_bienes }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Meta:</b>&nbsp; {{ $bien->meta_bienes }}
                      </div>
                      <label for="">Presentacion de Requerimiento</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_presentacion_req_inicio_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin :</b>&nbsp; {{ $bien->f_presentacion_req_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->presentacion_dias_bs}}
                      </div>
                      <label for="">Designacion de Cotizador</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_designacion_cotizador_inicio_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin :</b>&nbsp; {{ $bien->f_designacion_cotizador_fin_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->designacion_dias_bs }}
                      </div>
                      <label for="">Estudio de Mercado</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_estudio_mercado_inicio_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_estudio_mercado_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->estudiomercado_dias_bs }}
                      </div>
                      <label for="">Cuadro Comparativo</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_cuadro_comparativo_inicio_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_cuadro_comparativo_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->cuadro_comparativo_dias_bs }}
                      </div>
                      <label for="">Elaboracion de Certificacion</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_elaboracion_certificado_inicio_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_elaboracion_certificado_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->elaboracion_certificado_dias_bs}}
                      </div>
                      <label for="">Numero SIAF</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i>  Fecha inicio:</b>&nbsp; {{ $bien->f_numero_Siaf_inicio_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_numero_Siaf_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->numero_Siaf_dias_bs }}
                      </div>
                      <label for="">Orden de Compra</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i>  Fecha inicio:</b>&nbsp; {{ $bien->f_orden_compra_inicio_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_orden_compra_fin_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->orden_compra_dias_bs }}
                      </div>
                      <label for="">Notificación</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_notificacion_inicio_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha fin:</b>&nbsp; {{ $bien->f_notificacion_fin_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->notificacion_dias_bs}}
                      </div>
                      <label for="">Plazo de Ejecución</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->plazo_ejecucion_dias_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $bien->fecha_plazo_ejecucion_bs}}
                      </div>
                      <label for="">Ampliación de Plazo</label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Dias:</b>&nbsp; {{ $bien->ampliacion_plazo_dias_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $bien->fecha_ampliacion_plazo_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Observaciones:</b>&nbsp;
                        {!! nl2br(e('* ' . str_replace("\n", "\n* ", $bien->observaciones_bs))) !!}
                    </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Carta de Desestimiento:</b>&nbsp; {{ $bien->fecha_carta_desestimiento_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Entrega Bien:</b>&nbsp; {{ \Carbon\Carbon::parse($bien->f_entrega_bien_inicio_bs)->format('d/m/Y') }}
                    </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Recepcion Bien:</b>&nbsp; {{ $bien->f_recepcion_bien_inicio_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha Patrimonizacion:</b>&nbsp; {{ $bien->fecha_patrimonizacion_bs }}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Conformidad Patrimonizacion:</b>&nbsp; 
                        @if ($bien->conformidad_patrimonizacion_bs === 'SI')
                      <span class="badge badge-success" >SI</span>
                      @elseif ($bien->conformidad_patrimonizacion_bs === 'NO')
                      <span class="badge badge-danger">NO</span>
                      @else
                         <span class="badge badge-warning">EN ESPERA</span> 
                      @endif
                    </div>
                
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Conformidad Proyectista:</b>&nbsp; 
                        @if ($bien->conformidad_proyectista_bs === 'COMPLETADO')
                      <span class="badge badge-success" >COMPLETADO</span>
                      @elseif ($bien->conformidad_proyectista_bs === 'CANCELADO')
                      <span class="badge badge-danger">CANCELADO</span>
                      @else
                         <span class="badge badge-warning">EN PROCESO</span> 
                      @endif
                    </div>
                      <label for="">Envio a SGASA Penalidad </label>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i> Fecha:</b>&nbsp; {{ $bien->fecha_SGASA_penalidad_bs}}
                      </div>
                      <div class="col-12 py-2">
                        <b><i class="fas fa-file-signature"></i>Penalidad:</b>&nbsp; 
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
