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
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="meta" class="form-label">Meta:</label>
                                <input type="text"  name="meta_bienes" value="{{ $bien->meta_bienes}}" class="form-control input-auth" id="meta_bienes" required>
                            </div>
                            <div class="col-6">
                                <label for="siaf" class="form-label">SIAF (llenar posterior, no obligatorio)</label>
                                <input type="text" name="siaf_bienes" value="{{ $bien->siaf_bienes}}" class="form-control input-auth" placeholder="Ingrese SIAF" id="siaf">
                            </div>
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
                        <div class="row mb-2"><b>Presentación de Requerimiento</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="text"  name="nombre_requerimientos_bs" value="{{ $bien->nombre_requerimientos_bs}}" class="form-control input-auth" id="nombre_requerimientos_bs" placeholder="Ingrese Requerimiento">
                            </div>
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
                        <div class="row mb-2"><b>Designación de Cotizador</b></div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <input type="text"  name="nombre_cotizador_bs" value="{{ $bien->nombre_cotizador_bs}}" class="form-control input-auth" id="nombre_cotizador_bs" placeholder="Ingrese Cotizador">
                            </div>
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
                        <div class="row mb-1">
                            <div class="col-4"><b>Cotización</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_cotizacion_inicio_bs}}" name="f_cotizacion_inicio_bs" id="f_cotizacion_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cotizacion_inicio_edit', 'f_cotizacion_fin_edit', 'cotizacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_cotizacion_fin_bs}}" name="f_cotizacion_fin_bs" id="f_cotizacion_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_cotizacion_inicio_edit', 'f_cotizacion_fin_edit', 'cotizacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->cotizacion_dias_bs}}" name="cotizacion_dias_bs" id="cotizacion_dias_edit_{{ $bien->idBienes }}" readonly  >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Cuadro Comparativo</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="text"  name="nombre_cuadro_comparativo_bs" value="{{ $bien->nombre_cuadro_comparativo_bs}}" class="form-control input-auth" id="nombre_cuadro_comparativo" placeholder="Ingrese Cuadro Comparativo" >
                            </div>
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
                        <div class="row mb-2"><b>Nº de Certificación</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="number"  name="numero_certificacion_bs" value="{{ $bien->numero_certificacion_bs}}" class="form-control input-auth" id="numero_certificacion_bs" placeholder="Ingrese Nº" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_numero_certificacion_inicio_bs}}" name="f_numero_certificacion_inicio_bs" id="f_numero_certificacion_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_numero_certificacion_inicio_edit', 'f_numero_certificacion_fin_edit', 'numero_certificacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_numero_certificacion_fin_bs}}" name="f_numero_certificacion_fin_bs" id="f_numero_certificacion_fin_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_numero_certificacion_inicio_edit', 'f_numero_certificacion_fin_edit', 'numero_certificacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->numero_certificacion_dias_bs}}" name="numero_certificacion_dias_bs" id="numero_certificacion_dias_edit_{{ $bien->idBienes }}" readonly >
                            </div>
                        </div>
                        <!--<div class="row mb-2">
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
                        </div> -->
                        <div class="row mb-2"><b>Orden de Compra</b></div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <input type="number"  name="numero_orden_compra_bs" value="{{ $bien->numero_orden_compra_bs}}" class="form-control input-auth" id="numero_orden_compra_bs" placeholder="Ingrese Nº" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
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
                        <div class="row mb-3">
                            <div class="col-4"><b>Notificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_notificacion_inicio_bs}}" name="f_notificacion_inicio_bs" id="f_notificacion_inicio_edit_{{ $bien->idBienes }}" onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_notificacion_fin_bs}}" name="f_notificacion_fin_bs" id="f_notificacion_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $bien->idBienes }}); calcularFechaPlazoEjecucionedit_bs({{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->notificacion_dias_bs}}" name="notificacion_dias_bs" id="notificacion_dias_edit_{{ $bien->idBienes }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Plazo de Ejecución (Días)</b></div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth"  placeholder="Días" name="plazo_ejecucion_dias_bs" id="plazo_bs_edit_{{ $bien->idBienes }}" value="{{ $bien->plazo_ejecucion_dias_bs}}" style="width: 100px;" onchange="calcularFechaPlazoEjecucionedit_bs({{ $bien->idBienes }})" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth" value="{{ $bien->fecha_plazo_ejecucion_bs}}" name="fecha_plazo_ejecucion_bs" id="fecha_plazo_ejecucion_bs_edit_{{ $bien->idBienes }}" readonly  onchange="calcularFechaAmpliacionPlazoedit_bs({{ $bien->idBienes }})">
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
                                                <input type="number" name="ampliacion_plazo_dias_bs"  placeholder="Días" class="form-control input-auth" value="{{ $bien->ampliacion_plazo_dias_bs}}" id="ampliacionPlazo_bs_edit_{{ $bien->idBienes }}" style="width: 100px;"  onchange="calcularFechaAmpliacionPlazoedit_bs({{ $bien->idBienes }})" min="0" oninput="this.value = Math.abs(this.value)">
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
                            <div class="col-2">
                                <label for="entregable" class="form-label mt-2">Entrega Bien:</label>
                            </div>
                            <div class="col-3">
                                <input type="date" name="f_entrega_bien_inicio_bs" value="{{ $bien->f_entrega_bien_inicio_bs}}"  class="form-control input-auth date-input" >
                            </div>
                            <div class="col-2">
                                <label for="recepcion" class="form-label mt-2">Recepcion Bien:</label>
                            </div>
                            <div class="col-3">
                                <input type="date" name="f_recepcion_bien_inicio_bs" value="{{ $bien->f_recepcion_bien_inicio_bs}}"  class="form-control input-auth date-input" >
                            </div>
                        </div>
                        <div class="col-3"><b>Conformidad Patrimonización</b></div>
                        <div class="row mb-1">
                            <div class="col-4 py-2">
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
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->fecha_patrimonizacion_inicio_bs}}" name="fecha_patrimonizacion_inicio_bs" id="fecha_patrimonizacion_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('fecha_patrimonizacion_inicio_edit', 'fecha_patrimonizacion_fin_edit', 'patrimonizacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->fecha_patrimonizacion_fin_bs}}" name="fecha_patrimonizacion_fin_bs" id="fecha_patrimonizacion_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('fecha_patrimonizacion_inicio_edit', 'fecha_patrimonizacion_fin_edit', 'patrimonizacion_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->patrimonizacion_dias_bs}}" name="patrimonizacion_dias_bs" id="patrimonizacion_dias_edit_{{ $bien->idBienes }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Informe de Conformidad <br>(Proyectista)</b></div>
                        <div class="row mb-3">
                            <div class="col-4">
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
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_conformidad_proyectista_inicio_bs}}" name="f_conformidad_proyectista_inicio_bs" id="f_conformidad_proyectista_inicio_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_conformidad_proyectista_inicio_edit', 'f_conformidad_proyectista_fin_edit', 'conformidad_proyectista_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $bien->f_conformidad_proyectista_fin_bs}}" name="f_conformidad_proyectista_fin_bs" id="f_conformidad_proyectista_fin_edit_{{ $bien->idBienes }}"  onchange="calcularDiasedit_bs('f_conformidad_proyectista_inicio_edit', 'f_conformidad_proyectista_fin_edit', 'conformidad_proyectista_dias_edit', {{ $bien->idBienes }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $bien->conformidad_proyectista_dias_bs}}" name="conformidad_proyectista_dias_bs" id="conformidad_proyectista_dias_edit_{{ $bien->idBienes }}"  readonly >
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
                            <button type="submit" class="btn btn-warning mx-1" onclick="return validarFechaYAgregarEdit({{ $bien->idBienes }})"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
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
          },
          dropdownParent: $('#Modaleditbienes{{ $bien->idBienes }}')
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
    const plazoEjecucionDiasInput = document.getElementById(`plazo_bs_edit_${serviceId}`);
    const notificacionDias = parseInt(document.getElementById(`notificacion_dias_edit_${serviceId}`).value, 10);
    const fechaPlazoEjecucionInput = document.getElementById(`fecha_plazo_ejecucion_bs_edit_${serviceId}`);

    if (!fechaNotificacionFin) {
        console.log(`La fecha de notificación fin está vacía. Estableciendo plazoEjecucionDias a 0.`);
        plazoEjecucionDiasInput.value = 0;
        fechaPlazoEjecucionInput.value = '';
        calcularFechaAmpliacionPlazoedit_bs(serviceId); // Actualiza la ampliación de plazo
        return;
    }

    const plazoEjecucionDias = parseInt(plazoEjecucionDiasInput.value, 10);

    if (plazoEjecucionDias && !isNaN(notificacionDias)) {
        const fechaFin = new Date(fechaNotificacionFin);
        fechaFin.setDate(fechaFin.getDate() + notificacionDias + plazoEjecucionDias);
        const nuevaFecha = fechaFin.toISOString().split('T')[0];
        fechaPlazoEjecucionInput.value = nuevaFecha;
        calcularFechaAmpliacionPlazoedit_bs(serviceId); // Actualiza la ampliación de plazo
    } else {
        fechaPlazoEjecucionInput.value = '';
        calcularFechaAmpliacionPlazoedit_bs(serviceId); // Asegúrate de actualizar la ampliación de plazo si no se puede calcular la fecha
    }
}

// Función para recalcular la fecha de ampliación de plazo
function calcularFechaAmpliacionPlazoedit_bs(serviceId) {
    const fechaPlazoEjecucion = document.getElementById(`fecha_plazo_ejecucion_bs_edit_${serviceId}`).value;
    const ampliacionPlazoInput = document.getElementById(`ampliacionPlazo_bs_edit_${serviceId}`);
    const fechaAmpliacionPlazoInput = document.getElementById(`fecha_ampliacion_plazo_bs_edit_${serviceId}`);

    if (!fechaPlazoEjecucion || fechaPlazoEjecucion.trim() === "") {
        console.log('La fecha de plazo de ejecución está vacía. Estableciendo ampliaciónPlazoDias a 0.');
        ampliacionPlazoInput.value = 0; // Establece el valor de ampliación a 0 automáticamente
        fechaAmpliacionPlazoInput.value = ''; // Limpia la fecha de ampliación
        return; // Salir de la función
    }

    const ampliacionPlazoDias = parseInt(ampliacionPlazoInput.value, 10);

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
<script>
    function validarFechaYAgregarEdit(serviceId) {
        // Obtener los valores de los campos usando el serviceId pasado como parámetro
        var fechaNotificacionInicio = document.getElementById('f_notificacion_inicio_edit_' + serviceId).value;
        //var fechaNotificacionFin = document.getElementById('f_notificacion_fin_edit_' + serviceId).value;
        var plazoDias = document.getElementById('plazo_bs_edit_' + serviceId).value;
        var ampliacionPlazoDias = document.getElementById('ampliacionPlazo_bs_edit_' + serviceId).value;
        var fechaPlazoEjecucion = document.getElementById('fecha_plazo_ejecucion_bs_edit_' + serviceId);
        var fechaAmpliacionPlazo = document.getElementById('fecha_ampliacion_plazo_bs_edit_' + serviceId);

        // Convertir el valor de plazo y ampliación de plazo en números para manejar correctamente (0 será tratado como vacío)
        plazoDias = parseInt(plazoDias);
        ampliacionPlazoDias = parseInt(ampliacionPlazoDias);

        // Validar si ambos campos de fecha de notificación están vacíos y el plazo es 0
        if ((!plazoDias && plazoDias !== 0) && !fechaNotificacionInicio) {
            return true;  // No mostrar alerta, continuar normalmente
        }

        // Validar si el plazo tiene un valor pero faltan fechas de notificación
        if (plazoDias) {
            if (!fechaNotificacionInicio) {
                alert('Por favor, ingrese una fecha de notificación de inicio antes de agregar el plazo.');
                document.getElementById('plazo_bs_edit_' + serviceId).value = 0;
                fechaPlazoEjecucion.value = '';  // Limpiar el campo fecha_plazo_ejecucion
                return false;
            }
        }

        // Validar si el campo de ampliación de plazo tiene un valor pero falta la fecha de plazo de ejecución
        if (ampliacionPlazoDias > 0 && !fechaPlazoEjecucion.value) {
            alert('Por favor, seleccione una fecha de plazo de ejecución antes de agregar una ampliación de plazo.');
            document.getElementById('ampliacionPlazo_bs_edit_' + serviceId).value = 0;
            fechaAmpliacionPlazo.value = '';  // Limpiar el campo fecha_ampliacion_plazo
            return false;
        }

        // Si todo está bien, permitir la acción
        return true;
    }
</script>

    