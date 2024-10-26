<div class="modal fade text-left" id="ModalShowBienes{{ $bien->idBienes }}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header  bg-red text-white">
        <h4 class="modal-title"><i class="fas fa-users-cog"></i> Detalles del bien</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-12">
            <h5 style="display: inline-block;"><i class="fas fa-portrait"></i> Proyectista:</h5>
            <span style="display: inline-block;">
              {{ $bien->usuarios->nombreUsuario . ' ' . $bien->usuarios->apellidoUsuario }} &nbsp;
            </span>
            <span style="display: inline-block;">
              P: (
              @if ($bien->usuarios->profesiones->isNotEmpty())
                @foreach ($bien->usuarios->profesiones as $profesion)
                  {{ $profesion->nombreProfesion }}
                  @if (!$loop->last)
                    ,
                  @endif
                @endforeach
              @endif
              )
            </span>
            &nbsp; | &nbsp;
            <span style="display: inline-block;">
              E: (
              @if ($bien->usuarios->especialidades->isNotEmpty())
                @foreach ($bien->usuarios->especialidades as $especialidad)
                  {{ $especialidad->nombreEspecialidad }}
                  @if (!$loop->last)
                    ,
                  @endif
                @endforeach
              @endif
              )
            </span>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <b><i class="fas fa-tag"></i> Nombre bien:</b> 
            {{ $bien->nombre_bienes }}
          </div>
        </div>
        <!-- Meta y SIAF -->
        <div class="row mb-3">
          <div class="col-6">
            <b><i class="fas fa-file-signature"></i> Meta:</b> 
            {{ $bien->meta_bienes }}
          </div>
          <div class="col-6">
            <b><i class="fas fa-file-signature"></i> SIAF:</b> 
            {{ $bien->siaf_bienes }}
          </div>
        </div>
      
        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-1">
              <div class="card-header bg-custom text-white">
                <strong>Presentacion de Requerimiento</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-tag"></i> Nombre Requerimiento:</b>&nbsp; {{ $bien->nombre_requerimientos_bs }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_presentacion_req_inicio_bs ? \Carbon\Carbon::parse($bien->f_presentacion_req_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp; {{ $bien->f_presentacion_req_fin_bs ? \Carbon\Carbon::parse($bien->f_presentacion_req_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->presentacion_dias_bs}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Designacion de Cotizador</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-portrait"></i> Nombre Cotizador:</b>&nbsp; {{ $bien->nombre_cotizador_bs }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_designacion_cotizador_inicio_bs ? \Carbon\Carbon::parse($bien->f_designacion_cotizador_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp;  {{ $bien->f_designacion_cotizador_fin_bs ? \Carbon\Carbon::parse($bien->f_designacion_cotizador_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->designacion_dias_bs }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Cotizacion</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $bien->f_cotizacion_inicio_bs ? \Carbon\Carbon::parse($bien->f_cotizacion_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_cotizacion_fin_bs ? \Carbon\Carbon::parse($bien->f_cotizacion_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->cotizacion_dias_bs }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Cuadro Comparativo</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-tag"></i> Nombre Cuadro Comparativo:</b>&nbsp; {{ $bien->nombre_cuadro_comparativo_bs }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_cuadro_comparativo_inicio_bs ? \Carbon\Carbon::parse($bien->f_cuadro_comparativo_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_cuadro_comparativo_fin_bs ? \Carbon\Carbon::parse($bien->f_cuadro_comparativo_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->cuadro_comparativo_dias_bs }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Nº de Certificacion</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-hashtag"></i> Certificación:</b>&nbsp; {{ $bien->numero_certificacion_bs}}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_numero_certificacion_inicio_bs ? \Carbon\Carbon::parse($bien->f_numero_certificacion_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_numero_certificacion_fin_bs ? \Carbon\Carbon::parse($bien->f_numero_certificacion_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->numero_certificacion_dias_bs}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Orden de Compra</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-hashtag"></i> Orden:</b>&nbsp; {{ $bien->numero_orden_compra_bs}}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i>  Fecha inicio:</b>&nbsp; {{ $bien->f_orden_compra_inicio_bs ? \Carbon\Carbon::parse($bien->f_orden_compra_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_orden_compra_fin_bs ? \Carbon\Carbon::parse($bien->f_orden_compra_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->orden_compra_dias_bs }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Notificación</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_notificacion_inicio_bs ? \Carbon\Carbon::parse($bien->f_notificacion_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_notificacion_fin_bs ? \Carbon\Carbon::parse($bien->f_notificacion_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->notificacion_dias_bs}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Plazo de Ejecución</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->plazo_ejecucion_dias_bs }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_plazo_ejecucion_bs ? \Carbon\Carbon::parse($bien->fecha_plazo_ejecucion_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card border-warning mb-3">
          <div class="card-header bg-warning text-dark">
            <strong>Ampliación de Plazo</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 mb-1">
                <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->ampliacion_plazo_dias_bs }}
              </div>
              <div class="col-6 mb-1">
                <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_ampliacion_plazo_bs ? \Carbon\Carbon::parse($bien->fecha_ampliacion_plazo_bs)->format('d/m/Y') : 'Por Definir' }}
              </div>
              @if ($bien->observaciones_bs)
                <div class="col-12 py-3">
                  <b><i class="fas fa-calendar-alt"></i> Observaciones:</b>&nbsp;
                  <div class="col-12 mt-2">
                    <div class="card text-dark bg-light mb-0">
                      <div class="card-body pb-0">
                        <div class="col-12">
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
                <div class="col-12">
                  <b><i class="fas fa-calendar-alt"></i> Carta de Desestimiento:</b>&nbsp; {{ $bien->fecha_carta_desestimiento_bs ? \Carbon\Carbon::parse($bien->fecha_carta_desestimiento_bs)->format('d/m/Y') : 'Por Definir' }}
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="card-body mb-3" style="border: 2px solid #000;">
          <div class="row">
            <div class="col-6 mb-1">
              <b><i class="fas fa-calendar-alt"></i> Entrega Bien:</b>&nbsp; {{ $bien->f_entrega_bien_inicio_bs ? \Carbon\Carbon::parse($bien->f_entrega_bien_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
            </div>
            <div class="col-6 mb-1">
              <b><i class="fas fa-calendar-alt"></i> Recepcion Bien:</b>&nbsp; {{ $bien->f_recepcion_bien_inicio_bs ? \Carbon\Carbon::parse($bien->f_recepcion_bien_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Patrimonización</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->fecha_patrimonizacion_inicio_bs ? \Carbon\Carbon::parse($bien->fecha_patrimonizacion_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->fecha_patrimonizacion_fin_bs ? \Carbon\Carbon::parse($bien->fecha_patrimonizacion_fin_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->patrimonizacion_dias_bs}}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-clipboard-check"></i> Conformidad:</b>&nbsp;
                    @if ($bien->conformidad_patrimonizacion_bs === 'SI')
                      <span class="badge badge-success conformity-badge" >SI</span>
                    @elseif ($bien->conformidad_patrimonizacion_bs === 'NO')
                      <span class="badge badge-danger conformity-badge">NO</span>
                    @else
                      <span class="badge badge-warning conformity-badge">EN ESPERA</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Envio a SGASA Penalidad</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $bien->fecha_SGASA_penalidad_bs ? \Carbon\Carbon::parse($bien->fecha_SGASA_penalidad_bs)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->penalidad_dias_bs }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-exclamation-triangle"></i> Penalidad:</b>&nbsp;
                    @if ($bien->envio_bs === 'SI')
                      <span class="badge badge-danger conformity-badge" >SI</span>
                    @elseif ($bien->envio_bs === 'NO')
                      <span class="badge badge-success conformity-badge">NO</span>
                    @else
                      <span class="badge badge-warning conformity-badge">EN ESPERA</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card border-dark mb-3">
          <div class="card-header bg-custom text-white">
            <strong>Informe de Conformidad Proyectista</strong>
          </div>
          <div  class="card-body">
            <div class="row">
              <div class="col-6 mb-1">
                <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $bien->f_conformidad_proyectista_inicio_bs ? \Carbon\Carbon::parse($bien->f_conformidad_proyectista_inicio_bs)->format('d/m/Y') : 'Por Definir' }}
              </div>
              <div class="col-6 mb-1">
                <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $bien->f_conformidad_proyectista_fin_bs ? \Carbon\Carbon::parse($bien->f_conformidad_proyectista_fin_bs)->format('d/m/Y') : 'Por Definir' }}
              </div>
              <div class="col-6 mb-1">
                <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $bien->conformidad_proyectista_dias_bs}}
              </div>
              <div class="col-6 py-2">
                <b><i class="fas fa-clipboard-check"></i> Conformidad:</b>&nbsp;
                @if ($bien->conformidad_proyectista_bs === 'COMPLETADO')
                  <span class="badge badge-success conformity-badge" >
                    <i class="fas fa-check-circle"></i> COMPLETADO
                  </span>
                @elseif ($bien->conformidad_proyectista_bs === 'CANCELADO')
                  <span class="badge badge-danger conformity-badge">
                    <i class="fas fa-times-circle"></i> CANCELADO
                  </span>
                @else
                  <span class="badge badge-warning conformity-badge">
                    <i class="fas fa-exclamation-circle"></i> EN PROCESO
                  </span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .conformity-badge {
  font-size: 0.8rem;           /* Agranda la fuente */
  padding: 0.75rem 1.3rem;     /* Añade espacio alrededor del texto */
  border-radius: 50px;         /* Hace las esquinas más redondeadas */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Añade sombra suave */
  display: inline-block;       /* Asegura que se vea bien en línea */
  margin-top: 1rem;            /* Añade espacio arriba */
  transition: transform 0.3s ease, background 0.3s ease; /* Animación suave */
}

.conformity-badge:hover {
  transform: scale(1.1);       /* Efecto de agrandarse al pasar el ratón */
}

.badge-success {
  background: linear-gradient(135deg, #28a745, #218838); /* Gradiente verde */
  color: white;
}

.badge-danger {
  background: linear-gradient(135deg, #dc3545, #c82333); /* Gradiente rojo */
  color: white;
}
.badge-warning {
  background: linear-gradient(135deg, #ffc107, #e0a800); /* Gradiente amarillo */
  color: white;
}
  .bg-custom {
    background-color: #323436; /* Un tono de gris claro */
}
</style>
