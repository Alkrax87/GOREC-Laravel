<div class="modal fade text-left" id="ModalShow{{ $servicio->idServicio }}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-red text-white">
        <h4 class="modal-title"><i class="fas fa-wrench"></i> Detalles del Servicio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-12">
            <h5 style="display: inline-block;"><i class="fas fa-portrait"></i> Proyectista:</h5> 
            <span style="display: inline-block;">
              {{ $servicio->usuarios->nombreUsuario . ' ' . $servicio->usuarios->apellidoUsuario }} &nbsp;
            </span>
            <span style="display: inline-block;">
              P: (
              @if ($servicio->usuarios->profesiones->isNotEmpty())
                @foreach ($servicio->usuarios->profesiones as $profesion)
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
              @if ($servicio->usuarios->especialidades->isNotEmpty())
                @foreach ($servicio->usuarios->especialidades as $especialidad)
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
            <b><i class="fas fa-tag"></i> Nombre Servicio:</b> 
            {{ $servicio->nombre_servicio }}
          </div>
        </div>
        <!-- Meta y SIAF -->
        <div class="row mb-3">
          <div class="col-6">
            <b><i class="fas fa-file-signature"></i> Meta:</b> 
            {{ $servicio->meta }}
          </div>
          <div class="col-6">
            <b><i class="fas fa-file-signature"></i> SIAF:</b> 
            {{ $servicio->siaf }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-1"> <!-- Ajusta el tamaño de la columna según sea necesario -->
            <div class="card border-dark mb-1">
              <div class="card-header bg-custom text-white">
                <strong>Presentación de Requerimiento</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-tag"></i> Nombre Requerimiento:</b>&nbsp; {{ $servicio->nombre_requerimientos }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_presentacion_req_inicio ? \Carbon\Carbon::parse($servicio->f_presentacion_req_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_presentacion_req_fin ? \Carbon\Carbon::parse($servicio->f_presentacion_req_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Días:</b>&nbsp; {{ $servicio->presentacion_dias }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1"> <!-- Ajusta el tamaño de la columna según sea necesario -->
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Designacion de Cotizador</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-portrait"></i> Nombre Cotizador:</b>&nbsp; {{ $servicio->nombre_cotizador }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_designacion_cotizador_inicio ? \Carbon\Carbon::parse($servicio->f_designacion_cotizador_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin :</b>&nbsp; {{ $servicio->f_designacion_cotizador_fin ? \Carbon\Carbon::parse($servicio->f_designacion_cotizador_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Días:</b>&nbsp; {{ $servicio->designacion_dias }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- Presentacion de Requerimiento -->
        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Estudio de Mercado</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio :</b>&nbsp; {{ $servicio->f_estudio_mercado_inicio ? \Carbon\Carbon::parse($servicio->f_estudio_mercado_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_estudio_mercado_fin ? \Carbon\Carbon::parse($servicio->f_estudio_mercado_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->estudiomercado_dias }}
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
                    <b><i class="fas fa-tag"></i> Nombre Cuadro Comparativo:</b>&nbsp; {{ $servicio->nombre_cuadro_comparativo }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_inicio ? \Carbon\Carbon::parse($servicio->f_cuadro_comparativo_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_cuadro_comparativo_fin ? \Carbon\Carbon::parse($servicio->f_cuadro_comparativo_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->cuadro_comparativo_dias }}
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
                <strong>Nº de Certificación</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-hashtag"></i> Certificación:</b>&nbsp; {{ $servicio->numero_certificacion}}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_numero_certificacion_inicio ? \Carbon\Carbon::parse($servicio->f_numero_certificacion_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_numero_certificacion_fin ? \Carbon\Carbon::parse($servicio->f_numero_certificacion_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->numero_certificacion_dias}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="card border-dark mb-2">
              <div class="card-header bg-custom text-white">
                <strong>Orden de servicio / Contrato</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-hashtag"></i> Orden:</b>&nbsp; {{ $servicio->numero_orden }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i>  Fecha inicio:</b>&nbsp; {{ $servicio->f_orden_servicio_inicio ? \Carbon\Carbon::parse($servicio->f_orden_servicio_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_orden_servicio_fin ? \Carbon\Carbon::parse($servicio->f_orden_servicio_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6 mb-1">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->orden_servicio_dias }}
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
                  <div class="col-12 mb-1">
                    @if ($servicio->email_presencial === 'Email')
                        <i class="fas fa-envelope"></i>&nbsp; <span><b>Email</b></span>
                    @elseif ($servicio->email_presencial === 'Presencial')
                        <i class="fas fa-walking"></i>&nbsp;   <span><b>Presencial</b></span>
                    @endif
                  </div>
                  <div class="col-6">
                    <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_notificacion_inicio ? \Carbon\Carbon::parse($servicio->f_notificacion_inicio)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6">
                    <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_notificacion_fin ? \Carbon\Carbon::parse($servicio->f_notificacion_fin)->format('d/m/Y') : 'Por Definir' }}
                  </div>
                  <div class="col-6">
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->notificacion_dias}}
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
                    <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->plazo_ejecucion_dias }}
                  </div>
                  <div class="col-12 mb-1">
                    <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_plazo_ejecucion ? \Carbon\Carbon::parse($servicio->fecha_plazo_ejecucion)->format('d/m/Y') : 'Por Definir' }}
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
              <div class="col-2">
                <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->ampliacion_plazo_dias }}
              </div>
              <div class="col-5">
                <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $servicio->fecha_ampliacion_plazo ? \Carbon\Carbon::parse($servicio->fecha_ampliacion_plazo)->format('d/m/Y') : 'Por Definir' }}
              </div>
              @if ($servicio->observaciones)
                <div class="col-12 py-3">
                  <b><i class="fas fa-calendar-alt"></i> Observaciones:</b>&nbsp;
                  <div class="col-12 mt-2">
                    <div class="card text-dark bg-light mb-0">
                      <div class="card-body pb-0">
                        <div class="col-12">
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
                <div class="col-12">
                  <b><i class="fas fa-calendar-alt"></i> Carta de Desestimiento:</b>&nbsp;  {{ $servicio->fecha_carta_desestimiento ? \Carbon\Carbon::parse($servicio->fecha_carta_desestimiento)->format('d/m/Y') : 'Por Definir' }}
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-body mb-2" style="border: 2px solid #000;">
          <div class="row">
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Entrega del Producto:</b>&nbsp; {{ $servicio->f_entrega_producto ? \Carbon\Carbon::parse($servicio->f_entrega_producto)->format('d/m/Y') : 'Por Definir' }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Deriva a Proyectista:</b>&nbsp; {{ $servicio->fecha_derivar_proyectista ? \Carbon\Carbon::parse($servicio->fecha_derivar_proyectista)->format('d/m/Y') : 'Por Definir' }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Informe de Conformidad:</b>&nbsp;  {{ $servicio->fecha_informe_conformidad ? \Carbon\Carbon::parse($servicio->fecha_informe_conformidad)->format('d/m/Y') : 'Por Definir' }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Deriva a la SGEP (Administración):</b>&nbsp; {{ $servicio->fecha_SGEP_administracion ? \Carbon\Carbon::parse($servicio->fecha_SGEP_administracion)->format('d/m/Y') : 'Por Definir' }}
            </div>
          </div>
        </div>
        
        <!-- <h5 class="mb-0">Retorno a SGEP (Sub Gerencia)</h5>
        <div class="col-5 py-2">
          <b><i class="fas fa-calendar-alt"></i> Fecha inicio:</b>&nbsp; {{ $servicio->f_retorno_SGEP_inicio ? \Carbon\Carbon::parse($servicio->f_retorno_SGEP_inicio)->format('d/m/Y') : 'Por Definir' }}
        </div>
        <div class="col-5 py-2">
          <b><i class="fas fa-calendar-alt"></i> Fecha fin:</b>&nbsp; {{ $servicio->f_retorno_SGEP_fin ? \Carbon\Carbon::parse($servicio->f_retorno_SGEP_fin)->format('d/m/Y') : 'Por Definir' }}
        </div>
        <div class="col-2 py-2">
          <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->retorno_SGEP_dias}}
        </div> -->
        <div class="card border-dark mb-2">
          <div class="card-header bg-custom text-white">
            <strong>Envio a SGASA Penalidad</strong>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp;  {{ $servicio->fecha_SGASA_penalidad ? \Carbon\Carbon::parse($servicio->fecha_SGASA_penalidad)->format('d/m/Y') : 'Por Definir' }}
              </div>
              <div class="col-2">
                <b><i class="fas fa-calendar-check"></i> Dias:</b>&nbsp; {{ $servicio->penalidad_dias }}
              </div>
              <div class="col-6">
                <b><i class="fas fa-exclamation-triangle"></i> Penalidad:</b>&nbsp;
                @if ($servicio->envio === 'SI')
                  <span class="badge badge-danger conformity-badge" >SI</span>
                @elseif ($servicio->envio === 'NO')
                  <span class="badge badge-success conformity-badge">NO</span>
                @else
                  <span class="badge badge-warning conformity-badge">EN ESPERA</span>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 py-4 text-center" style="background-color: #f8f9fa; border-radius: 10px;">
          <b style="font-size: 1.3rem;">
            <i class="fas fa-clipboard-check"></i> CONFORMIDAD:
          </b>&nbsp;
          @if ($servicio->conformidad === 'COMPLETADO')
            <span class="badge badge-success conformity-badge">
              <i class="fas fa-check-circle"></i> COMPLETADO
            </span>
          @elseif ($servicio->conformidad === 'CANCELADO')
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