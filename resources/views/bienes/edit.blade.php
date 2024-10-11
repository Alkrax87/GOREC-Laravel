<form id="mi-formulario-actualizar_bs{{ $bien->idBienes }}" action="{{ route('bienes.update', $bien->idBienes) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade text-left" id="Modaleditbienes{{ $bien->idBienes }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-users-cog"></i> Editar biens</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                            <h3 class="text-center">Bienes</h3>

                            @if (Auth::user()->isAdmin)
                                <div class="form-outline mb-4">
                                    <label class="form-label">Inversión</label>
                                    <select name="idInversion" id="idInversion-bs-{{ $bien->idBienes }}" class="form-select form-select-sm input-auth" required >
                                        <option value="" disabled>Selecciona una inversión</option>
                                        @foreach ($inversiones as $inversion)
                                          <option value="{{ $inversion->idInversion }}" {{ $bien->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                                            {{ $inversion->nombreCortoInversion }}
                                          </option>
                                          @endforeach
                                      </select>
                                  </div>
                                  @else
                                  <!-- Campo hidden para enviar la inversión seleccionada -->
                                  <input type="hidden" name="idInversion" value="{{ $bien->idInversion }}">
                                  <h3>Inversión: {{ $bien->inversion->nombreCortoInversion }}</h3>
                                @endif

 
                                
                                  @if (Auth::user()->isAdmin)
                                  <div class="form-outline mb-4">
                                    <label class="form-label" for="idUsuario">Proyectistas</label>
                                    <div id="usuarios-container-create">
                                      <div class="input-group mb-2">
                                        <select name="idUsuario" id="idUsuarios-bs-{{ $bien->idBienes }}" class="form-select form-select-sm input-auth" required>
                                            <option value="" disabled>Selecciona un usuario</option>
                                            @foreach ($usuarios as $usuario)
                                              <option value="{{ $usuario->idUsuario }}" {{ $bien->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                                                {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                                              </option>
                                            @endforeach
                                          </select>

                                      </div>
                                    </div>
                                  </div>
                                  @else
                                  <!-- Campo hidden para enviar la inversión seleccionada -->
                                  <input type="hidden" name="idUsuario" value="{{ $bien->idUsuario}}">
                                  <h3>Proyectista: {{ $bien->usuarios->nombreUsuario . ' ' . $bien->usuarios->apellidoUsuario }}</h3>
                                @endif
                                <div class="mb-3">
                                    <label for="nombrebien" class="form-label">Nombre bien:</label>
                                    <input type="text" class="form-control" value="{{ $bien->nombre_bienes }}" name="nombre_bienes" id="nombrebien" required>
                                </div>

                                <div class="mb-3">
                                    <label for="meta" class="form-label">Meta:</label>
                                    <input type="text"  name="meta_bienes" value="{{ $bien->meta_bienes}}" class="form-control" id="meta_bienes" required>
                                </div>

                                <h2 class="my-4">Formulario de Procesos</h2>

                                <!-- Fila de títulos -->
                                <div class="proceso-titulos">
                                    <div></div> <!-- Espacio para el proceso -->
                                    <div>F. Inicio</div>
                                    <div>F. Fin</div>
                                    <div class="titulo-dias">Cant. Días</div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Presentación de Requerimiento</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_presentacion_req_inicio_bs}}" name="f_presentacion_req_inicio_bs" id="f_presentacion_req_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_presentacion_req_fin_bs}}" name="f_presentacion_req_fin_bs" id="f_presentacion_req_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->presentacion_dias_bs}}" name="presentacion_dias_bs"  id="presentacion_dias_edit_{{ $bien->idBienes }}" readonly  required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Designación de Cotizador</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_designacion_cotizador_inicio_bs}}" name="f_designacion_cotizador_inicio_bs" id="f_designacion_cotizador_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_designacion_cotizador_fin_bs}}" name="f_designacion_cotizador_fin_bs" id="f_designacion_cotizador_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->designacion_dias_bs}}" name="designacion_dias_bs" id="designacion_dias_edit_{{ $bien->idBienes }}"  readonly required >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Estudio de Mercado</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_estudio_mercado_inicio_bs}}" name="f_estudio_mercado_inicio_bs" id="f_estudio_mercado_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_estudio_mercado_fin_bs}}" name="f_estudio_mercado_fin_bs" id="f_estudio_mercado_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->estudiomercado_dias_bs}}" name="estudiomercado_dias_bs" id="estudiomercado_dias_edit_{{ $bien->idBienes }}" readonly required >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Cuadro Comparativo</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_cuadro_comparativo_inicio_bs}}" name="f_cuadro_comparativo_inicio_bs" id="f_cuadro_comparativo_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_cuadro_comparativo_fin_bs}}" name="f_cuadro_comparativo_fin_bs" id="f_cuadro_comparativo_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->cuadro_comparativo_dias_bs}}" name="cuadro_comparativo_dias_bs" id="cuadro_comparativo_dias_edit_{{ $bien->idBienes }}" readonly required >
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Elaboración de Certificación</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_elaboracion_certificado_inicio_bs}}" name="f_elaboracion_certificado_inicio_bs" id="f_elaboracion_certificado_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_elaboracion_certificado_fin_bs}}" name="f_elaboracion_certificado_fin_bs" id="f_elaboracion_certificado_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->elaboracion_certificado_dias_bs}}" name="elaboracion_certificado_dias_bs" id="elaboracion_certificado_dias_edit_{{ $bien->idBienes }}" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Numero SIAF</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_numero_Siaf_inicio_bs}}" name="f_numero_Siaf_inicio_bs" id="f_numero_Siaf_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_numero_Siaf_inicio_edit', 'f_numero_Siaf_fin_edit', 'numero_Siaf_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_numero_Siaf_fin_bs}}" name="f_numero_Siaf_fin_bs" id="f_numero_Siaf_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_numero_Siaf_inicio_edit', 'f_numero_Siaf_fin_edit', 'numero_Siaf_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->numero_Siaf_dias_bs}}" name="numero_Siaf_dias_bs" id="numero_Siaf_dias_edit_{{ $bien->idBienes }}"  readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Orden de Compra</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_orden_compra_inicio_bs}}" name="f_orden_compra_inicio_bs" id="f_orden_compra_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_orden_compra_inicio_edit', 'f_orden_compra_fin_edit', 'orden_compra_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_orden_compra_fin_bs}}" name="f_orden_compra_fin_bs" id="f_orden_compra_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_orden_compra_inicio_edit', 'f_orden_compra_fin_edit', 'oorden_compra_dias_edit', {{ $bien->idBienes }})" required>
                                        <input type="number" class="form-control proceso-dias" value="{{ $bien->orden_compra_dias_bs}}" name="orden_compra_dias_bs" id="orden_compra_dias_edit_{{ $bien->idBienes }}"  readonly required>
                                    </div>
                                </div>

                                <div class="proceso-row">
                                    <label class="proceso-label">Notificación</label>
                                    <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_notificacion_inicio_bs}}" name="f_notificacion_inicio_bs" id="f_notificacion_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }})" required>
                                    <input type="date" class="form-control proceso-fecha" value="{{ $bien->f_notificacion_fin_bs}}" name="f_notificacion_fin_bs" id="f_notificacion_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }})" required>
                                    <input type="number" class="form-control proceso-dias" value="{{ $bien->notificacion_dias_bs}}" name="notificacion_dias_bs" id="notificacion_dias_edit_{{ $bien->idBienes }}"  readonly required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="plazo" class="form-label">Plazo de Ejecución (Días):</label>
                                    <input type="number" class="form-control" name="plazo_ejecucion_dias_bs" id="plazo_bs_edit_{{ $bien->idBienes }}" value="{{ $bien->plazo_ejecucion_dias_bs}}" style="width: 100px;" onchange="calcularFechaPlazoEjecucionedit_bs({{ $bien->idBienes }})" required>
                                    <input type="date" class="form-control proceso-fecha" value="{{ $bien->fecha_plazo_ejecucion_bs}}" name="fecha_plazo_ejecucion_bs" id="fecha_plazo_ejecucion_bs_edit_{{ $bien->idBienes }}" readonly required>


                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="extender_PlazosEdit_bs{{$bien->idBienes}}" @if ($bien->observaciones || $bien->ampliacion_plazo_dias || $bien->fecha_ampliacion_plazo || $bien->fecha_carta_desestimiento)  checked @endif>
                                        <label class="form-check-label" for="extender_PlazosEdit_bs{{$bien->idBienes}}">
                                            Extender Plazo
                                        </label>
                                    </div>
                                </div>
                                <div id="editar_Ampliacion_bs{{$bien->idBienes}}" class="card" style="@if ($bien->observaciones || $bien->ampliacion_plazo_dias || $bien->fecha_ampliacion_plazo || $bien->fecha_carta_desestimiento) display: block; @else display: none; @endif">
                                
                                <div class="mb-3">
                                    <label for="ampliacionPlazo" class="form-label">Ampliación de Plazo (Días):</label>
                                    <input type="number" name="ampliacion_plazo_dias_bs" class="form-control" value="{{ $bien->ampliacion_plazo_dias_bs}}" id="ampliacionPlazo_bs_edit_{{ $bien->idBienes }}" style="width: 100px;"  onchange="calcularFechaAmpliacionPlazoedit_bs({{ $bien->idBienes }})">
                                    <input type="date" name="fecha_ampliacion_plazo_bs" class="form-control date-input mt-2" value="{{ $bien->fecha_ampliacion_plazo_bs}}" id="fecha_ampliacion_plazo_bs_edit_{{ $bien->idBienes }}" readonly>
                                </div>

                               <!-- Observaciones -->
                               <label for="observaciones" class="form-label">Observaciones:</label>
                    <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservaciones_bs({{ $bien->idBienes }})"><i class="fas fa-plus"></i></button>

                    <div id="observacion-container-a{{ $bien->idBienes }}">

                        <!-- Las observaciones se llenarán aquí -->

                    </div>

                    <input type="hidden" name="observaciones_bs" id="observaciones-final-a{{ $bien->idBienes }}">


                                <div class="mb-3">
                                    <label for="desestimiento" class="form-label">Carta de Desestimiento:</label>
                                    <input type="date" name="fecha_carta_desestimiento_bs" value="{{ $bien->fecha_carta_desestimiento_bs}}" class="form-control date-input">
                                </div>
                            </div>
                                <div class="divider"></div>
                                <div class="mb-3">
                                    <label for="entregable" class="form-label">Entrega Bien:</label>
                                    <input type="date" name="f_entrega_bien_inicio_bs" value="{{ $bien->f_entrega_bien_inicio_bs}}"  class="form-control date-input" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="recepcion" class="form-label">Recepcion Bien:</label>
                                    <input type="date" name="f_recepcion_bien_inicio_bs" value="{{ $bien->f_recepcion_bien_inicio_bs}}"  class="form-control date-input" required>
                                </div>
                    
                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Patrimonizacion</label>
                                        <input type="date" class="form-control proceso-fecha" value="{{ $bien->fecha_patrimonizacion_bs}}"  name="fecha_patrimonizacion_bs"  required>
                                    </div>
                                </div>
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="conformidad" class="form-label me-2">Conformidad Patrimonizacion:</label>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadSi_pa" value="SI" {{ $bien->conformidad_patrimonizacion_bs === 'SI' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadSi_pa">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadNo_pa" value="NO" {{ $bien->conformidad_patrimonizacion_bs === 'NO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadNo_pa">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadEspera_pa" value="EN ESPERA" {{ $bien->conformidad_patrimonizacion_bs === null || $bien->conformidad_patrimonizacion_bs === 'EN ESPERA' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadEspera">En espera</label>
                                    </div>
                                </div>
                    
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="conformidad" class="form-label me-2">Informe de Conformidad(Proyectista):</label>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadSi" value="COMPLETADO" {{ $bien->conformidad_proyectista_bs === 'COMPLETADO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadSiC">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadNo" value="CANCELADO" {{ $bien->conformidad_proyectista_bs === 'CANCELADO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadNoC">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadEspera" value="EN PROCESO" {{ $bien->conformidad_proyectista_bs === null || $bien->conformidad_proyectista_bs === 'EN PROCESO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadEsperaC">En Proceso</label>
                                    </div>
                                    
                                </div>
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="penalidad" class="form-label me-2">Envío a SGASA Penalidad:</label>
                                    <div class="form-check me-2">
                                        <input type="date" class="form-control proceso-fecha" value="{{$bien->fecha_SGASA_penalidad_bs}}" name="fecha_SGASA_penalidad_bs">
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioSi" value="SI" {{ $bien->envio_bs === 'SI' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioNo" value="NO" {{ $bien->envio_bs === 'NO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioNo">No</label>
                                    </div>

                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioEspera" value="EN ESPERA" {{ $bien->envio_bs  === null || $bien->envio_bs  === 'EN ESPERA' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioEspera">En espera</label>
                                    </div>
                                </div>
                    
                                <div class="col-12 py-2 text-center">
                                    <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                                    <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
      // Ejecutar cuando el modal se muestra
      $('#Modaleditbienes{{ $bien->idBienes }}').on('shown.bs.modal', function () {
        // Inicializar select2 en el select de inversión
        const inversionSelect = $('#idInversion-bs-{{ $bien->idBienes }}').select2({
          placeholder: "Selecciona una inversión",
          allowClear: true,
          language: {
            noResults: function () {
              return "No se encontró la inversión";
            }
          }
        });
        // Comprobar si ya se ha añadido el listener para evitar duplicados
        if (!inversionSelect.data('listener-added')) {
          // Evento para manejar el cambio de inversión
          inversionSelect.on('change', function () {
            const inversionId = this.value; // Obtener el ID de la inversión seleccionada
            if (inversionId) {
              loadUsuarios(inversionId); // Llamar a la función para cargar usuarios
            }
          });
          inversionSelect.data('listener-added', true); // Marcar el event listener como añadido
        }
        // Si ya hay una inversión seleccionada, cargar sus usuarios
        const inversionId = inversionSelect.val();
        if (inversionId) {
          loadUsuarios(inversionId);
        }
  
        // Función para cargar usuarios basados en el ID de la inversión
        function loadUsuarios(inversionId) {
          // Obtener el select de usuarios para este bien
          const usuariosSelect = $('#idUsuarios-bs-{{ $bien->idBienes }}');
  
           // Limpiar el select de usuarios antes de cargar nuevos datos
            usuariosSelect.empty();

            // Guardar el ID del usuario que ya estaba en el bien
            const usuarioSeleccionado = '{{ $bien->idUsuario }}';
  
          // Realizar la solicitud fetch para obtener los usuarios según la inversión
          fetch(`/usuarios-por-bienes/${inversionId}`)
            .then((response) => {
              if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
              }
              return response.json();
            })
            .then((usuarios) => {
              usuarios.forEach((usuario) => {
                // Crear un option con los datos del usuario
                const profesiones = usuario.profesiones.map((p) => p.nombreProfesion).join(', ');
                const especialidades = usuario.especialidades.map((e) => e.nombreEspecialidad).join(', ');
  
                const option = `<option value="${usuario.idUsuario}" 
                                 ${usuario.idUsuario == usuarioSeleccionado ? 'selected' : ''}>
                                ${usuario.nombreUsuario} ${usuario.apellidoUsuario} =>
                                P: (${profesiones}) &nbsp; | &nbsp; E: (${especialidades})
                              </option>`;
                // Añadir el option al select de usuarios
                usuariosSelect.append(option);
              });
            })
            .catch((error) => {
              console.error('Error al cargar los usuarios:', error);
            });
        }
      });
  
      // Destruir el select2 en el select de inversión cuando se cierra el modal
      $('#Modaleditbienes{{ $bien->idBienes }}').on('hidden.bs.modal', function () {
        $('#idInversion-bs-{{ $bien->idBienes }}').select2('destroy');
      });
    });
  </script>
<script>
    // Obtener el checkbox y el div específicos para este usuario
  const extender_PlazosEdit_bs{{$bien->idBienes}} = document.getElementById('extender_PlazosEdit_bs{{$bien->idBienes}}');
  const editar_Ampliacion_bs{{$bien->idBienes}} = document.getElementById('editar_Ampliacion_bs{{$bien->idBienes}}');

  // Añadir un listener para el evento 'change'
  extender_PlazosEdit_bs{{$bien->idBienes}}.addEventListener('change', function() {
    if (this.checked) {
        editar_Ampliacion_bs{{$bien->idBienes}}.style.display = 'block';
    } else {
        editar_Ampliacion_bs{{$bien->idBienes}}.style.display = 'none';
    }
  });

</script>
<script>
    $(document).ready(function() {
        $('#Modaleditbienes{{ $bien->idBienes }}').on('shown.bs.modal', function () {
            const observaciones = `{{ $bien->observaciones_bs }}`; // Ya tenemos las observaciones
            console.log('Observaciones:', observaciones); // Asegúrate de ver esto en la consola
            poblarObservaciones({{ $bien->idBienes }}, observaciones); // Poblamos las observaciones al abrir el modal
        });
    });

    // Función para poblar las observaciones existentes
    function poblarObservaciones(idBienes, observaciones) {
        const container = document.getElementById('observacion-container-a' + idBienes);
        const observacionesArray = observaciones.split('\n'); // Divide las observaciones por saltos de línea
        console.log('Cargando observaciones para el bien:', idBienes); // Verifica si se llama correctamente
        console.log('Observaciones:', observaciones); // Verifica el valor pasado

        // Limpiar el contenedor antes de agregar nuevas observaciones
        container.innerHTML = '';

        observacionesArray.forEach(observacion => {
            if (observacion.trim() !== '') { // Solo agregar si la observación no está vacía
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <textarea class="form-control observacion-input-a" rows="3">${observacion.trim()}</textarea>
                    <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;
                container.appendChild(div); // Agrega la observación al contenedor
            }
        });
    }

    // Función para añadir nuevas observaciones
    function addObservaciones_bs(idBienes) {
        const container = document.getElementById('observacion-container-a' + idBienes); // Asegúrate de que idBienes sea pasado correctamente
        console.log('Añadiendo observación para el bien:', idBienes); // Verifica si el evento es detectado
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            
            <textarea class="form-control observacion-input-a" rows="3"></textarea>
            <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
             
        `;
        container.appendChild(div); // Añadir el nuevo textarea al contenedor
    }

    // Función para eliminar un textarea
    function removeElement(element) {
        element.parentNode.remove();
    }

    // Concatenar observaciones antes de enviar el formulario
    document.getElementById('mi-formulario-actualizar_bs{{ $bien->idBienes }}').addEventListener('submit', function(event) {
    const observacionesInputs = document.querySelectorAll('#observacion-container-a{{ $bien->idBienes }} .observacion-input-a');
    let observacionesFinal = '';

    observacionesInputs.forEach((textarea, index) => {
        if (textarea.value.trim() !== '') {
            observacionesFinal += textarea.value.trim() + '\n';
        }
    });
    // Asignar las observaciones al input oculto específico del bien
    document.getElementById('observaciones-final-a{{ $bien->idBienes }}').value = observacionesFinal;
    
    });
     // Obtener el checkbox y el div específicos para este usuario
    // Concatenar observaciones antes de enviar el formulario
</script>
<script>
    //SCRIPT PARA CALCULAR LAS FECHAS
    function calcularDiasedit_bs(inicioId, finId, diasId, serviceId) {
    const fechaInicio = document.getElementById(`${inicioId}_${serviceId}`).value;
    const fechaFin = document.getElementById(`${finId}_${serviceId}`).value;
    const diasInput = document.getElementById(`${diasId}_${serviceId}`);

    if (fechaInicio && fechaFin) {
        const inicio = new Date(fechaInicio);
        const fin = new Date(fechaFin);
        const diferencia = fin - inicio;
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));

        console.log("Días calculados:", dias);

        diasInput.value = dias >= 0 ? dias : 0;
        calcularFechaPlazoEjecucionedit_bs(serviceId);
    } else {
        diasInput.value = '';
    }
}

// Función para recalcular la fecha de plazo de ejecución
function calcularFechaPlazoEjecucionedit_bs(serviceId) {
    const fechaNotificacionFin = document.getElementById(`f_notificacion_fin_edit_${serviceId}`).value;
    const plazoEjecucionDias = parseInt(document.getElementById(`plazo_bs_edit_${serviceId}`).value, 10);
    const notificacionDias = parseInt(document.getElementById(`notificacion_dias_edit_${serviceId}`).value, 10);
    const fechaPlazoEjecucionInput = document.getElementById(`fecha_plazo_ejecucion_bs_edit_${serviceId}`);

    console.log(`Service ID: ${serviceId}, Fecha Notificación Fin: ${fechaNotificacionFin}, Plazo Ejecución Días: ${plazoEjecucionDias}, Notificación Días: ${notificacionDias}`);

    if (fechaNotificacionFin && plazoEjecucionDias && !isNaN(notificacionDias)) {
        const fechaFin = new Date(fechaNotificacionFin);
        fechaFin.setDate(fechaFin.getDate() + notificacionDias + plazoEjecucionDias);
        const nuevaFecha = fechaFin.toISOString().split('T')[0];
        fechaPlazoEjecucionInput.value = nuevaFecha;
        calcularFechaAmpliacionPlazoedit_bs(serviceId);
    } else {
        fechaPlazoEjecucionInput.value = '';
    }
}

// Función para recalcular la fecha de ampliación de plazo
function calcularFechaAmpliacionPlazoedit_bs(serviceId) {
    const fechaPlazoEjecucion = document.getElementById(`fecha_plazo_ejecucion_bs_edit_${serviceId}`).value;
    const ampliacionPlazoDias = parseInt(document.getElementById(`ampliacionPlazo_bs_edit_${serviceId}`).value, 10);
    const fechaAmpliacionPlazoInput = document.getElementById(`fecha_ampliacion_plazo_bs_edit_${serviceId}`);

    console.log(`Service ID: ${serviceId}, Fecha Plazo Ejecución: ${fechaPlazoEjecucion}, Ampliación Plazo Días: ${ampliacionPlazoDias}`);

    if (fechaPlazoEjecucion && ampliacionPlazoDias) {
        const fechaPlazo = new Date(fechaPlazoEjecucion);
        fechaPlazo.setDate(fechaPlazo.getDate() + ampliacionPlazoDias);
        const nuevaFechaAmpliacion = fechaPlazo.toISOString().split('T')[0];
        fechaAmpliacionPlazoInput.value = nuevaFechaAmpliacion;
    } else {
        fechaAmpliacionPlazoInput.value = '';
    }
}
</script>


    