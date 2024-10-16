<form id="mi-formulario-actualizar{{ $servicio->idServicio }}" action="{{ route('servicios.update', $servicio->idServicio) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade text-left" id="Modaleditservicios{{ $servicio->idServicio }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-wrench"></i> Editar Servicios</h4>
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
                                    <select name="idInversion" id="idInversion-{{ $servicio->idServicio }}" class="form-select form-select-sm input-auth" required >
                                        <option value="" disabled>Selecciona una inversión</option>
                                        @foreach ($inversiones as $inversion)
                                            <option value="{{ $inversion->idInversion }}" {{ $servicio->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                                                {{ $inversion->nombreCortoInversion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label class="form-label" for="idUsuario">Proyectistas</label>
                                    <div id="usuarios-container-create">
                                        <div class="input-group mb-2">
                                            <select name="idUsuario" id="idUsuarios-{{ $servicio->idServicio }}" class="form-select form-select-sm input-auth" required>
                                                <option value="" disabled>Selecciona un usuario</option>
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->idUsuario }}" {{ $servicio->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                                                        {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="idInversion" value="{{ $servicio->idInversion }}">
                            <h4>Inversión: {{ $servicio->inversion->nombreCortoInversion }}</h4>
                            <input type="hidden" name="idUsuario" value="{{ $servicio->idUsuario}}">
                            <h5>Proyectista: {{ $servicio->usuarios->nombreUsuario . ' ' . $servicio->usuarios->apellidoUsuario }}</h5>
                        @endif
                        <div class="mb-3">
                            <label for="nombreServicio" class="form-label">Nombre Servicio</label>
                            <input type="text" class="form-control input-auth input-auth" value="{{ $servicio->nombre_servicio }}" name="nombre_servicio" id="nombreServicio" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="meta" class="form-label">Meta</label>
                                <input type="text"  name="meta" value="{{ $servicio->meta}}" class="form-control input-auth input-auth" id="meta" required>
                            </div>
                            <div class="col-6">
                                <label for="siaf" class="form-label">SIAF (llenar posterior, no obligatorio)</label>
                                <input type="text" name="siaf" value="{{ $servicio->siaf}}" class="form-control input-auth input-auth" id="siaf">
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
                        <div class="row mb-2">
                            <div class="col-4"><b>Presentación de Requerimiento</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_presentacion_req_inicio}}" name="f_presentacion_req_inicio" id="f_presentacion_req_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_presentacion_req_fin}}" name="f_presentacion_req_fin" id="f_presentacion_req_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_presentacion_req_inicio_edit', 'f_presentacion_req_fin_edit', 'presentacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->presentacion_dias}}" name="presentacion_dias"  id="presentacion_dias_edit_{{ $servicio->idServicio }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Designación de Cotizador</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_designacion_cotizador_inicio}}" name="f_designacion_cotizador_inicio" id="f_designacion_cotizador_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_designacion_cotizador_fin}}" name="f_designacion_cotizador_fin" id="f_designacion_cotizador_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_designacion_cotizador_inicio_edit', 'f_designacion_cotizador_fin_edit', 'designacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->designacion_dias}}" name="designacion_dias" id="designacion_dias_edit_{{ $servicio->idServicio }}"  readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Estudio de Mercado</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_estudio_mercado_inicio}}" name="f_estudio_mercado_inicio" id="f_estudio_mercado_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_estudio_mercado_fin}}" name="f_estudio_mercado_fin" id="f_estudio_mercado_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_estudio_mercado_inicio_edit', 'f_estudio_mercado_fin_edit', 'estudiomercado_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->estudiomercado_dias}}" name="estudiomercado_dias" id="estudiomercado_dias_edit_{{ $servicio->idServicio }}" readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Cuadro Comparativo</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_cuadro_comparativo_inicio}}" name="f_cuadro_comparativo_inicio" id="f_cuadro_comparativo_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_cuadro_comparativo_fin}}" name="f_cuadro_comparativo_fin" id="f_cuadro_comparativo_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_cuadro_comparativo_inicio_edit', 'f_cuadro_comparativo_fin_edit', 'cuadro_comparativo_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->cuadro_comparativo_dias}}" name="cuadro_comparativo_dias" id="cuadro_comparativo_dias_edit_{{ $servicio->idServicio }}" readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Elaboración de Certificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_elaboracion_certificado_inicio}}" name="f_elaboracion_certificado_inicio" id="f_elaboracion_certificado_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_elaboracion_certificado_fin}}" name="f_elaboracion_certificado_fin" id="f_elaboracion_certificado_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_elaboracion_certificado_inicio_edit', 'f_elaboracion_certificado_fin_edit', 'elaboracion_certificado_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->elaboracion_certificado_dias}}" name="elaboracion_certificado_dias" id="elaboracion_certificado_dias_edit_{{ $servicio->idServicio }}" readonly >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Orden de Servicio / Contrato</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_orden_servicio_inicio}}" name="f_orden_servicio_inicio" id="f_orden_servicio_inicio_edit_{{ $servicio->idServicio }}"  onchange="calcularDiasedit('f_orden_servicio_inicio_edit', 'f_orden_servicio_fin_edit', 'orden_servicio_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_orden_servicio_fin}}" name="f_orden_servicio_fin" id="f_orden_servicio_fin_edit_{{ $servicio->idServicio }}"  onchange="calcularDiasedit('f_orden_servicio_inicio_edit', 'f_orden_servicio_fin_edit', 'orden_servicio_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->orden_servicio_dias}}" name="orden_servicio_dias" id="orden_servicio_dias_edit_{{ $servicio->idServicio }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Notificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_notificacion_inicio}}" name="f_notificacion_inicio" id="f_notificacion_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_notificacion_fin}}" name="f_notificacion_fin" id="f_notificacion_fin_edit_{{ $servicio->idServicio }}"  onchange="calcularDiasedit('f_notificacion_inicio_edit', 'f_notificacion_fin_edit', 'notificacion_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->notificacion_dias}}" name="notificacion_dias" id="notificacion_dias_edit_{{ $servicio->idServicio }}"  readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Plazo de Ejecución (Días)</b></div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" name="plazo_ejecucion_dias" id="plazo_edit_{{ $servicio->idServicio }}" value="{{ $servicio->plazo_ejecucion_dias}}" style="width: 100px;" onchange="calcularFechaPlazoEjecucionedit({{ $servicio->idServicio }})" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->fecha_plazo_ejecucion}}" name="fecha_plazo_ejecucion" id="fecha_plazo_ejecucion_edit_{{ $servicio->idServicio }}" readonly >
                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="extender_PlazosEdit{{$servicio->idServicio}}" @if ($servicio->observaciones || $servicio->ampliacion_plazo_dias || $servicio->fecha_ampliacion_plazo || $servicio->fecha_carta_desestimiento)  checked @endif>
                                    <label class="form-check-label" for="extender_PlazosEdit{{$servicio->idServicio}}">
                                        Extender Plazo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="editar_Ampliacion{{$servicio->idServicio}}" style="@if ($servicio->observaciones || $servicio->ampliacion_plazo_dias || $servicio->fecha_ampliacion_plazo || $servicio->fecha_carta_desestimiento) display: block; @else display: none; @endif">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-outline mb-2">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="ampliacionPlazo" class="form-label">Ampliación de Plazo (Días)</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="ampliacion_plazo_dias" class="form-control input-auth" value="{{ $servicio->ampliacion_plazo_dias}}" id="ampliacionPlazo_edit_{{ $servicio->idServicio }}" style="width: 100px;"  onchange="calcularFechaAmpliacionPlazoedit({{ $servicio->idServicio }})" min="0" oninput="this.value = Math.abs(this.value)">
                                            </div>
                                            <div class="col-3">
                                                <input type="date" name="fecha_ampliacion_plazo" class="form-control input-auth" value="{{ $servicio->fecha_ampliacion_plazo}}" id="fecha_ampliacion_plazo_edit_{{ $servicio->idServicio }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label for="observaciones" class="form-label">Observaciones</label>
                                        <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservacioness({{ $servicio->idServicio }})"><i class="fas fa-plus"></i></button>
                                        <div id="observacion-container-a{{ $servicio->idServicio }}"></div>
                                        <input type="hidden" name="observaciones" id="observaciones-final-a{{ $servicio->idServicio }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="desestimiento" class="form-label">Carta de Desestimiento</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" name="fecha_carta_desestimiento" value="{{ $servicio->fecha_carta_desestimiento}}" class="form-control input-auth date-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Entregable Mesa de Partes:</b></div>
                            <div class="col-3">
                                <input type="date" name="f_mesa_partes_inicio" value="{{ $servicio->f_mesa_partes_inicio}}" class="form-control input-auth date-input" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Retorno a SGEP(Sub Gerencia)</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_retorno_SGEP_inicio}}" name="f_retorno_SGEP_inicio" id="f_retorno_SGEP_inicio_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_retorno_SGEP_inicio_edit', 'f_retorno_SGEP_fin_edit', 'retorno_SGEP_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->f_retorno_SGEP_fin}}" name="f_retorno_SGEP_fin" id="f_retorno_SGEP_fin_edit_{{ $servicio->idServicio }}" onchange="calcularDiasedit('f_retorno_SGEP_inicio_edit', 'f_retorno_SGEP_fin_edit', 'retorno_SGEP_dias_edit', {{ $servicio->idServicio }})" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" value="{{ $servicio->retorno_SGEP_dias}}" name="retorno_SGEP_dias" id="retorno_SGEP_dias_edit_{{ $servicio->idServicio }}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Deriva a Proyectista</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->fecha_derivar_proyectista}}" name="fecha_derivar_proyectista" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Informe de Conformidad</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->fecha_informe_conformidad}}" name="fecha_informe_conformidad" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Deriva a la SGEP (Administracion)</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{ $servicio->fecha_SGEP_administracion}}" name="fecha_SGEP_administracion" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Conformidad</b></div>
                            <div class="col-3">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad" id="conformidadSi" value="COMPLETADO" {{ $servicio->conformidad === 'COMPLETADO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadSi">Sí</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad" id="conformidadNo" value="CANCELADO" {{ $servicio->conformidad === 'CANCELADO"' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadNo">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad" id="conformidadEspera" value="EN PROCESO" {{ $servicio->conformidad === null || $servicio->conformidad === 'EN PROCESO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="conformidadEspera">En proceso</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Envío a SGASA Penalidad</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" value="{{$servicio->fecha_SGASA_penalidad}}" name="fecha_SGASA_penalidad">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth"  value="{{$servicio->penalidad_dias}}" name="penalidad_dias" id="penalidad_dias" placeholder="Días" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <div class="checkbox-container pt-2">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio" id="envioSi" value="SI" {{ $servicio->envio === 'SI' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio" id="envioNo" value="NO" {{ $servicio->envio === 'NO' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="envioNo">No</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio" id="envioEspera" value="EN ESPERA" {{ $servicio->envio === null || $servicio->envio === 'EN ESPERA' ? 'checked' : '' }}>
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
      $('#Modaleditservicios{{ $servicio->idServicio }}').on('shown.bs.modal', function () {
        // Inicializar select2 en el select de inversión
        const inversionSelect = $('#idInversion-{{ $servicio->idServicio }}').select2({
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
          // Obtener el select de usuarios para este servicio
          const usuariosSelect = $('#idUsuarios-{{ $servicio->idServicio }}');
  
           // Limpiar el select de usuarios antes de cargar nuevos datos
            usuariosSelect.empty();

            // Guardar el ID del usuario que ya estaba en el servicio
            const usuarioSeleccionado = '{{ $servicio->idUsuario }}';
  
          // Realizar la solicitud fetch para obtener los usuarios según la inversión
          fetch(`/usuarios-por-servicios/${inversionId}`)
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
      $('#Modaleditservicios{{ $servicio->idServicio }}').on('hidden.bs.modal', function () {
        $('#idInversion-{{ $servicio->idServicio }}').select2('destroy');
      });
    });
  </script>
<script>
    // Obtener el checkbox y el div específicos para este usuario
  const extender_PlazosEdit{{$servicio->idServicio}} = document.getElementById('extender_PlazosEdit{{$servicio->idServicio}}');
  const editar_Ampliacion{{$servicio->idServicio}} = document.getElementById('editar_Ampliacion{{$servicio->idServicio}}');

  // Añadir un listener para el evento 'change'
  extender_PlazosEdit{{$servicio->idServicio}}.addEventListener('change', function() {
    if (this.checked) {
        editar_Ampliacion{{$servicio->idServicio}}.style.display = 'block';
    } else {
        editar_Ampliacion{{$servicio->idServicio}}.style.display = 'none';
    }
  });

</script>
<script>
    $(document).ready(function() {
        $('#Modaleditservicios{{ $servicio->idServicio }}').on('shown.bs.modal', function () {
            const observaciones = `{{ $servicio->observaciones }}`; // Ya tenemos las observaciones
            console.log('Observaciones:', observaciones); // Asegúrate de ver esto en la consola
            populateObservaciones({{ $servicio->idServicio }}, observaciones); // Poblamos las observaciones al abrir el modal
        });
    });

    // Función para poblar las observaciones existentes
    function populateObservaciones(idServicio, observaciones) {
        const container = document.getElementById('observacion-container-a' + idServicio);
        const observacionesArray = observaciones.split('\n'); // Divide las observaciones por saltos de línea
        console.log('Cargando observaciones para el servicio:', idServicio); // Verifica si se llama correctamente
        console.log('Observaciones:', observaciones); // Verifica el valor pasado

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
    function addObservacioness(idServicio) {
        const container = document.getElementById('observacion-container-a' + idServicio); // Asegúrate de que idServicio sea pasado correctamente
        console.log('Añadiendo observación para el servicio:', idServicio); // Verifica si el evento es detectado
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
    document.getElementById('mi-formulario-actualizar{{ $servicio->idServicio }}').addEventListener('submit', function(event) {
    const observacionesInputs = document.querySelectorAll('#observacion-container-a{{ $servicio->idServicio }} .observacion-input-a');
    let observacionesFinal = '';

    observacionesInputs.forEach((textarea, index) => {
        if (textarea.value.trim() !== '') {
            observacionesFinal += textarea.value.trim() + '\n';
        }
    });
    // Asignar las observaciones al input oculto específico del servicio
    document.getElementById('observaciones-final-a{{ $servicio->idServicio }}').value = observacionesFinal;
    
    });
     // Obtener el checkbox y el div específicos para este usuario
    // Concatenar observaciones antes de enviar el formulario
</script>
<script>
    //SCRIPT PARA CALCULAR LAS FECHAS
    function calcularDiasedit(inicioId, finId, diasId, serviceId) {
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
        calcularFechaPlazoEjecucionedit(serviceId);
    } else {
        diasInput.value = '';
    }
}

// Función para recalcular la fecha de plazo de ejecución
function calcularFechaPlazoEjecucionedit(serviceId) {
    const fechaNotificacionFin = document.getElementById(`f_notificacion_fin_edit_${serviceId}`).value;
    const plazoEjecucionDias = parseInt(document.getElementById(`plazo_edit_${serviceId}`).value, 10);
    const notificacionDias = parseInt(document.getElementById(`notificacion_dias_edit_${serviceId}`).value, 10);
    const fechaPlazoEjecucionInput = document.getElementById(`fecha_plazo_ejecucion_edit_${serviceId}`);

    console.log(`Service ID: ${serviceId}, Fecha Notificación Fin: ${fechaNotificacionFin}, Plazo Ejecución Días: ${plazoEjecucionDias}, Notificación Días: ${notificacionDias}`);

    if (fechaNotificacionFin && plazoEjecucionDias && !isNaN(notificacionDias)) {
        const fechaFin = new Date(fechaNotificacionFin);
        fechaFin.setDate(fechaFin.getDate() + notificacionDias + plazoEjecucionDias);
        const nuevaFecha = fechaFin.toISOString().split('T')[0];
        fechaPlazoEjecucionInput.value = nuevaFecha;
        calcularFechaAmpliacionPlazoedit(serviceId);
    } else {
        fechaPlazoEjecucionInput.value = '';
    }
}

// Función para recalcular la fecha de ampliación de plazo
function calcularFechaAmpliacionPlazoedit(serviceId) {
    const fechaPlazoEjecucion = document.getElementById(`fecha_plazo_ejecucion_edit_${serviceId}`).value;
    const ampliacionPlazoDias = parseInt(document.getElementById(`ampliacionPlazo_edit_${serviceId}`).value, 10);
    const fechaAmpliacionPlazoInput = document.getElementById(`fecha_ampliacion_plazo_edit_${serviceId}`);

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


    