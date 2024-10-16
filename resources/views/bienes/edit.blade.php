<form id="mi-formulario-actualizar_bs{{ $bien->idBienes }}" action="{{ route('bienes.update', $bien->idBienes) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade text-left" id="Modaleditbienes{{ $bien->idBienes }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-truck-moving"></i> Editar bienes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if (Auth::user()->isAdmin)
                            <div class="row mb-3">
                                <div class="col-7">
                                    <label class="form-label">Inversión</label>
                                    <select name="idInversion" id="idInversion-bs-{{ $bien->idBienes }}" class="form-select form-select-sm input-auth" required>
                                        <option value="" disabled>Selecciona una inversión</option>
                                        @foreach ($inversiones as $inversion)
                                            <option value="{{ $inversion->idInversion }}" {{ $bien->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                                                {{ $inversion->nombreCortoInversion }}
                                            </option>
                                          @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
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
                            </div>
                        @else
                            <input type="hidden" name="idInversion" value="{{ $bien->idInversion }}">
                            <h4>Inversión: {{ $bien->inversion->nombreCortoInversion }}</h4>
                            <input type="hidden" name="idUsuario" value="{{ $bien->idUsuario}}">
                            <h5>Proyectista: {{ $bien->usuarios->nombreUsuario . ' ' . $bien->usuarios->apellidoUsuario }}</h5>
                        @endif
                        <div class="mb-3">
                            <label for="nombrebien" class="form-label">Nombre bien:</label>
                            <input type="text" class="form-control input-auth" value="{{ $bien->nombre_bienes }}" name="nombre_bienes" id="nombrebien" required>
                        </div>
                        <div class="mb-3">
                            <label for="meta" class="form-label">Meta:</label>
                            <input type="text"  name="meta_bienes" value="{{ $bien->meta_bienes}}" class="form-control input-auth" id="meta_bienes" required>
                        </div>
                        <div class="w-100 text-center">
                            <h4 class="my-3">Formulario de Procesos</h4>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-3"><b>Fecha Inicio</b></div>
                            <div class="col-3"><b>Fecha Fin</b></div>
                            <div class="col-2"><b>Cant. Dias</b></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Presentación de Requerimiento</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_presentacion_req_inicio_bs}}" name="f_presentacion_req_inicio_bs" id="f_presentacion_req_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_presentacion_req_fin_bs}}" name="f_presentacion_req_fin_bs" id="f_presentacion_req_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->presentacion_dias_bs}}" name="presentacion_dias_bs"  id="presentacion_dias_edit_{{ $bien->idBienes }}" readonly  >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Designación de Cotizador</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_designacion_cotizador_inicio_bs}}" name="f_designacion_cotizador_inicio_bs" id="f_designacion_cotizador_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_designacion_cotizador_fin_bs}}" name="f_designacion_cotizador_fin_bs" id="f_designacion_cotizador_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->designacion_dias_bs}}" name="designacion_dias_bs" id="designacion_dias_edit_{{ $bien->idBienes }}"  readonly  >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Estudio de Mercado</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_estudio_mercado_inicio_bs}}" name="f_estudio_mercado_inicio_bs" id="f_estudio_mercado_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_estudio_mercado_fin_bs}}" name="f_estudio_mercado_fin_bs" id="f_estudio_mercado_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->estudiomercado_dias_bs}}" name="estudiomercado_dias_bs" id="estudiomercado_dias_edit_{{ $bien->idBienes }}" readonly  >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Cuadro Comparativo</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_cuadro_comparativo_inicio_bs}}" name="f_cuadro_comparativo_inicio_bs" id="f_cuadro_comparativo_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_cuadro_comparativo_fin_bs}}" name="f_cuadro_comparativo_fin_bs" id="f_cuadro_comparativo_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->cuadro_comparativo_dias_bs}}" name="cuadro_comparativo_dias_bs" id="cuadro_comparativo_dias_edit_{{ $bien->idBienes }}" readonly  >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Elaboración de Certificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_elaboracion_certificado_inicio_bs}}" name="f_elaboracion_certificado_inicio_bs" id="f_elaboracion_certificado_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_elaboracion_certificado_fin_bs}}" name="f_elaboracion_certificado_fin_bs" id="f_elaboracion_certificado_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->elaboracion_certificado_dias_bs}}" name="elaboracion_certificado_dias_bs" id="elaboracion_certificado_dias_edit_{{ $bien->idBienes }}" readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Numero SIAF</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_numero_Siaf_inicio_bs}}" name="f_numero_Siaf_inicio_bs" id="f_numero_Siaf_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_numero_Siaf_inicio_edit', 'f_numero_Siaf_fin_edit', 'numero_Siaf_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_numero_Siaf_fin_bs}}" name="f_numero_Siaf_fin_bs" id="f_numero_Siaf_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_numero_Siaf_inicio_edit', 'f_numero_Siaf_fin_edit', 'numero_Siaf_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->numero_Siaf_dias_bs}}" name="numero_Siaf_dias_bs" id="numero_Siaf_dias_edit_{{ $bien->idBienes }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Orden de Compra</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_orden_compra_inicio_bs}}" name="f_orden_compra_inicio_bs" id="f_orden_compra_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_orden_compra_inicio_edit', 'f_orden_compra_fin_edit', 'orden_compra_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_orden_compra_fin_bs}}" name="f_orden_compra_fin_bs" id="f_orden_compra_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_orden_compra_inicio_edit', 'f_orden_compra_fin_edit', 'orden_compra_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->orden_compra_dias_bs}}" name="orden_compra_dias_bs" id="orden_compra_dias_edit_{{ $bien->idBienes }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Notificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_notificacion_inicio_bs}}" name="f_notificacion_inicio_bs" id="f_notificacion_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_notificacion_fin_bs}}" name="f_notificacion_fin_bs" id="f_notificacion_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->notificacion_dias_bs}}" name="notificacion_dias_bs" id="notificacion_dias_edit_{{ $bien->idBienes }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Plazo de Ejecución (Días)</b></div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" name="plazo_ejecucion_dias_bs" id="plazo_bs_edit_{{ $bien->idBienes }}" value="{{ $bien->plazo_ejecucion_dias_bs}}" style="width: 100px;" onchange="calcularFechaPlazoEjecucionedit_bs({{ $bien->idBienes }})" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth" value="{{ $bien->fecha_plazo_ejecucion_bs}}" name="fecha_plazo_ejecucion_bs" id="fecha_plazo_ejecucion_bs_edit_{{ $bien->idBienes }}" readonly >
                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="extender_PlazosEdit_bs{{$bien->idBienes}}" @if ($bien->observaciones_bs || $bien->ampliacion_plazo_dias_bs || $bien->fecha_ampliacion_plazo_bs || $bien->fecha_carta_desestimiento_bs)  checked @endif>
                                    <label class="form-check-label" for="extender_PlazosEdit_bs{{$bien->idBienes}}">
                                        Extender Plazo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="editar_Ampliacion_bs{{$bien->idBienes}}" style="@if ($bien->observaciones_bs || $bien->ampliacion_plazo_dias_bs || $bien->fecha_ampliacion_plazo_bs || $bien->fecha_carta_desestimiento_bs) display: block; @else display: none; @endif">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-outline mb-2">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="ampliacionPlazo" class="form-label">Ampliación de Plazo (Días):</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="ampliacion_plazo_dias_bs" class="form-control input-auth" value="{{ $bien->ampliacion_plazo_dias_bs}}" id="ampliacionPlazo_bs_edit_{{ $bien->idBienes }}" style="width: 100px;"  onchange="calcularFechaAmpliacionPlazoedit_bs({{ $bien->idBienes }})" min="0" oninput="this.value = Math.abs(this.value)">
                                            </div>
                                            <div class="col-3">
                                                <input type="date" name="fecha_ampliacion_plazo_bs" class="form-control input-auth date-input mt-2" value="{{ $bien->fecha_ampliacion_plazo_bs}}" id="fecha_ampliacion_plazo_bs_edit_{{ $bien->idBienes }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label for="observaciones" class="form-label">Observaciones:</label>
                                        <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservaciones_bs({{ $bien->idBienes }})"><i class="fas fa-plus"></i></button>
                                        <div id="observacion-container-a{{ $bien->idBienes }}"></div>
                                        <input type="hidden" name="observaciones_bs" id="observaciones-final-a{{ $bien->idBienes }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="desestimiento" class="form-label">Carta de Desestimiento:</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" name="fecha_carta_desestimiento_bs" value="{{ $bien->fecha_carta_desestimiento_bs}}" class="form-control input-auth date-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2"><b>Entrega Bien</b></div>
                            <div class="col-3">
                                <input type="date" name="f_entrega_bien_inicio_bs" value="{{ $bien->f_entrega_bien_inicio_bs}}"  class="form-control input-auth date-input" >
                            </div>
                            <div class="col-2"><b>Recepcion Bien</b></div>
                            <div class="col-3">
                                <input type="date" name="f_recepcion_bien_inicio_bs" value="{{ $bien->f_recepcion_bien_inicio_bs}}"  class="form-control input-auth date-input" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="proceso-label">Patrimonizacion</label>
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->fecha_patrimonizacion_bs}}"  name="fecha_patrimonizacion_bs"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="proceso-label">Conformidad Patrimonización</label>
                            </div>
                            <div class="col-3">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadSi_pa" value="SI" {{ $bien->conformidad_patrimonizacion_bs === 'SI' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadSi_pa">Sí</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadNo_pa" value="NO" {{ $bien->conformidad_patrimonizacion_bs === 'NO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadNo_pa">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadEspera_pa" value="EN ESPERA" {{ $bien->conformidad_patrimonizacion_bs === null || $bien->conformidad_patrimonizacion_bs === 'EN ESPERA' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadEspera">En espera</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Informe de Conformidad(Proyectista)</b></div>
                            <div class="col-3">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadSi" value="COMPLETADO" {{ $bien->conformidad_proyectista_bs === 'COMPLETADO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadSiC">Sí</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadNo" value="CANCELADO" {{ $bien->conformidad_proyectista_bs === 'CANCELADO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadNoC">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadEspera" value="EN PROCESO" {{ $bien->conformidad_proyectista_bs === null || $bien->conformidad_proyectista_bs === 'EN PROCESO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadEsperaC">En Proceso</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Envío a SGASA Penalidad</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth" value="{{$bien->fecha_SGASA_penalidad_bs}}" name="fecha_SGASA_penalidad_bs">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" value="{{ $bien->penalidad_dias_bs}}" name="penalidad_dias_bs" id="penalidad_dias_bs" placeholder="Días" min="0" oninput="this.value = Math.abs(this.value)" >
                            </div>
                            <div class="col-3">
                                <div class="checkbox-container mt-2">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioSi" value="SI" {{ $bien->envio_bs === 'SI' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioNo" value="NO" {{ $bien->envio_bs === 'NO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioNo">No</label>
                                    </div>

                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioEspera" value="EN ESPERA" {{ $bien->envio_bs  === null || $bien->envio_bs  === 'EN ESPERA' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioEspera">En espera</label>
                                    </div>
                                </div>
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
          width: '100%', 
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
            poblarObservaciones({{ $bien->idBienes }}, observaciones); // Poblamos las observaciones al abrir el modal
        });
    });

    // Función para poblar las observaciones existentes
    function poblarObservaciones(idBienes, observaciones) {
        const container = document.getElementById('observacion-container-a' + idBienes);
        const observacionesArray = observaciones.split('\n'); // Divide las observaciones por saltos de línea

        // Limpiar el contenedor antes de agregar nuevas observaciones
        container.innerHTML = '';

        observacionesArray.forEach(observacion => {
            if (observacion.trim() !== '') { // Solo agregar si la observación no está vacía
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <textarea class="form-control input-auth observacion-input-a" rows="3">${observacion.trim()}</textarea>
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
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            
            <textarea class="form-control input-auth observacion-input-a" rows="3"></textarea>
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
<style>
    /* Ajustar el z-index de Select2 */
    .select2-container .select2-selection--single {
      height: 38px;
      border-top-right-radius: 0px;
      border-bottom-right-radius: 0px;
    }
    .select2-container .select2-selection--single:focus {
      border-color: #72081f;
      outline: none;
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .style-button {
      border-top-left-radius: 0px;
      border-bottom-left-radius: 0px;
    }
    .select2-container .select2-dropdown {
      z-index: 9999;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable  {
      background-color: #9C0C27 !important; /* Cambia este color al que desees */
      color: rgb(248, 243, 243) !important;/* Cambia el color del texto si es necesario */
    }
    body {
      background-color: #000;
    }
    select {
      font-weight: normal;
      }
    select option.bold {
      font-weight: bold;
    }
    section {
      margin-top: 100px;
    }
    #crearCuenta {
      display: none;
    }
    /* Others */
    .center-items {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* Card Style */
    .cascading-left {
      margin-left: -50px;
    }
    /* Input Style  */
    .input-auth {
      display: block;
      width: 100%;
      height: calc(1.5em + 0.75rem + 2px);
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: all 0.3s ease-in-out;
    }
    .form-check-input:checked {
      background-color: #9C0C27;
      border-color: #9C0C27;
    }
    .form-check-input:focus {
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .input-auth:focus {
      border-color: #72081f;
      outline: none;
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .input-autht:focus::placeholder {
      color: transparent;
    }
    /* Btn Style  */
    .btn-gorec {
      width: 250px;
      height: 50px;
      background-color: #9C0C27;
      color: #fff;
      border-radius: 50px
    }
    .btn-gorec:hover {
      background-color: #72081f;
      color: #fff;;
    }
    /* Line */
    .line {
      border: 0;
      border-top: 1px solid #72081f;
      margin: 1rem 0;
      width: 50%;
    }
    /* Redirection */
    .login-direction {
      color: #72081f;
      text-decoration: none;
    }
    @media (max-width: 991.98px) {
      .cascading-left {
        margin-left: 0px;
      }
      section {
        margin-top: 0px;
      }
    }
  </style>

    