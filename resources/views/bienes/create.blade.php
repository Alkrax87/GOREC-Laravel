<form id="mi-formulario_bs" action="{{ route('bienes.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCreateBien">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-truck-moving"></i> Crear Bienes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-7">
                                <label class="form-label">Inversión</label>
                                <select name="idInversion" id="idInversion-create_bs" class="form-select form-select-sm input-auth" required>
                                    <option value="" disabled selected>Selecciona una inversión</option>
                                    @foreach ($inversiones as $inversion)
                                        <option value="{{ $inversion->idInversion }}">
                                            {{ $inversion->nombreCortoInversion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label class="form-label" for="idUsuario">Proyectistas</label>
                                <div id="usuarios-container-create">
                                    <div class="input-group mb-2">
                                        <select name="idUsuario" class="form-select form-select-sm input-auth" required id="usuariosSelect-create_bs">
                                        <option value="" disabled selected>Selecciona un usuario</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nombreServicio" class="form-label">Nombre Bien:</label>
                            <input type="text" class="form-control input-auth" name="nombre_bienes" id="nombreServicio" placeholder="Ingrese Bien" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="meta" class="form-label">Meta:</label>
                                <input type="text"  class="form-control input-auth" name="meta_bienes" id="meta" placeholder="Ingrese Meta" required>
                            </div>
                            <div class="col-6">
                                <label for="siaf" class="form-label">SIAF (llenar posterior, no obligatorio)</label>
                                <input type="text" name="siaf_bienes" class="form-control input-auth" placeholder="Ingrese SIAF" id="siaf">
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
                                <input type="text"  name="nombre_requerimientos_bs" class="form-control input-auth" id="nombre_requerimientos_bs" placeholder="Ingrese Requerimiento">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_presentacion_req_inicio_bs" id="f_presentacion_req_inicio_bs" onchange="calcularDias('f_presentacion_req_inicio_bs', 'f_presentacion_req_fin_bs', 'presentacion_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_presentacion_req_fin_bs" id="f_presentacion_req_fin_bs" onchange="calcularDias('f_presentacion_req_inicio_bs', 'f_presentacion_req_fin_bs', 'presentacion_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="presentacion_dias_bs"  id="presentacion_dias_bs" readonly placeholder="Días"  >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Designación de Cotizador</b></div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <input type="text"  name="nombre_cotizador_bs" class="form-control input-auth" id="nombre_cotizador_bs" placeholder="Ingrese Cotizador">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_designacion_cotizador_inicio_bs" id="f_designacion_cotizador_inicio_bs" onchange="calcularDias('f_designacion_cotizador_inicio_bs', 'f_designacion_cotizador_fin_bs', 'designacion_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_designacion_cotizador_fin_bs" id="f_designacion_cotizador_fin_bs" onchange="calcularDias('f_designacion_cotizador_inicio_bs', 'f_designacion_cotizador_fin_bs', 'designacion_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="designacion_dias_bs" id="designacion_dias_bs" readonly placeholder="Días"  >
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4"><b>Cotización</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cotizacion_inicio_bs" id="f_cotizacion_inicio_bs" onchange="calcularDias('f_cotizacion_inicio_bs', 'f_cotizacion_fin_bs', 'cotizacion_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cotizacion_fin_bs" id="f_cotizacion_fin_bs" onchange="calcularDias('f_cotizacion_inicio_bs', 'f_cotizacion_fin_bs', 'cotizacion_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="cotizacion_dias_bs" id="cotizacion_dias_bs" readonly placeholder="Días"  >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Cuadro Comparativo</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="text"  name="nombre_cuadro_comparativo_bs" class="form-control input-auth" id="nombre_cuadro_comparativo_bs" placeholder="Ingrese Cuadro Comparativo" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cuadro_comparativo_inicio_bs" id="f_cuadro_comparativo_inicio_bs" onchange="calcularDias('f_cuadro_comparativo_inicio_bs', 'f_cuadro_comparativo_fin_bs', 'cuadro_comparativo_diasv')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cuadro_comparativo_fin_bs" id="f_cuadro_comparativo_fin_bs" onchange="calcularDias('f_cuadro_comparativo_inicio_bs', 'f_cuadro_comparativo_fin_bs', 'cuadro_comparativo_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="cuadro_comparativo_dias_bs" id="cuadro_comparativo_dias_bs" readonly placeholder="Días"  >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Nº de Certificación</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="number"  name="numero_certificacion_bs" class="form-control input-auth" id="numero_certificacion_bs" placeholder="Ingrese Nº " min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_certificacion_inicio_bs" id="f_numero_certificacion_inicio_bs" onchange="calcularDias('f_numero_certificacion_inicio_bs', 'f_numero_certificacion_fin_bs', 'numero_certificacion_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_certificacion_fin_bs" id="f_numero_certificacion_fin_bs" onchange="calcularDias('f_numero_certificacion_inicio_bs', 'f_numero_certificacion_fin_bs', 'numero_certificacion_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="numero_certificacion_dias_bs" id="numero_certificacion_dias_bs" placeholder="Días" readonly  >
                            </div>
                        </div>
                        <!--<div class="row mb-2">
                            <div class="col-4"><b>Numero Siaf</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_Siaf_inicio_bs" id="f_numero_Siaf_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_numero_Siaf_inicio_bs', 'f_numero_Siaf_fin_bs', 'numero_Siaf_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_Siaf_fin_bs" id="f_numero_Siaf_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_numero_Siaf_inicio_bs', 'f_numero_Siaf_fin_bs', 'numero_Siaf_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="numero_Siaf_dias_bs" id="numero_Siaf_dias_bs" placeholder="Días" readonly  >
                            </div>
                        </div>-->
                        <div class="row mb-2"><b>Orden de Compra</b></div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <input type="number"  name="numero_orden_compra_bs" class="form-control input-auth" id="numero_orden_compra_bs" placeholder="Ingrese Nº " min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_orden_compra_inicio_bs" id="f_orden_compra_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_orden_compra_inicio_bs', 'f_orden_compra_fin_bs', 'orden_compra_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_orden_compra_fin_bs" id="f_orden_compra_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_orden_compra_inicio_bs', 'f_orden_compra_fin_bs', 'orden_compra_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="orden_compra_dias_bs" id="orden_compra_dias_bs" placeholder="Días" readonly  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Notificación</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_notificacion_inicio_bs" id="f_notificacion_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_notificacion_inicio_bs', 'f_notificacion_fin_bs', 'notificacion_dias_bs')"  >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_notificacion_fin_bs" id="f_notificacion_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_notificacion_inicio_bs', 'f_notificacion_fin_bs', 'notificacion_dias_bs')"  >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="notificacion_dias_bs" id="notificacion_dias_bs" placeholder="Días" readonly  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Plazo de Ejecución (Días):</b></div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" placeholder="Días" name="plazo_ejecucion_dias_bs" id="plazo_bs" onchange="calcularFechaPlazoEjecucion()" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_plazo_ejecucion_bs" id="fecha_plazo_ejecucion_bs" readonly  >
                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="extenderPlazo_bs" >
                                    <label class="form-check-label" for="extenderPlazo_bs">
                                        Extender Plazo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="ampliacion_bs" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-outline mb-2">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">Ampliación de Plazo (Días):</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="ampliacion_plazo_dias_bs" class="form-control input-auth" placeholder="Días" id="ampliacionPlazo_bs" onchange="calcularFechaAmpliacionPlazo()" min="0" oninput="this.value = Math.abs(this.value)">
                                            </div>
                                            <div class="col-3">
                                                <input type="date" name="fecha_ampliacion_plazo_bs" class="form-control input-auth" id="fecha_ampliacion_plazo_bs" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label for="observaciones_bs" class="form-label">Observaciones</label>
                                        <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservaciones()"><i class="fas fa-plus"></i></button>
                                        <div id="observacion-container_bs">
                                            <div class="input-group mb-2">
                                                <textarea class="form-control observacion-input" rows="3"></textarea>
                                                <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="observaciones_bs" id="observaciones-final_bs">
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="desestimiento" class="form-label">Carta de Desestimiento</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" name="fecha_carta_desestimiento_bs" class="form-control input-auth">
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
                                <input type="date" name="f_entrega_bien_inicio_bs" class="form-control input-auth date-input"  >
                            </div>
                            <div class="col-2">
                                <label for="recepcion" class="form-label mt-2">Recepcion Bien:</label>
                            </div>
                            <div class="col-3">
                                <input type="date" name="f_recepcion_bien_inicio_bs" class="form-control input-auth date-input"  >
                            </div>
                        </div>
                        <div class="col-3"><b>Conformidad Patrimonización</b></div>
                        <div class="row mb-1">
                            <div class="col-4 py-2">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadSi_pa" value="SI">
                                        <label class="form-check-label" for="conformidadSi_pa">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadNo_pa" value="NO">
                                        <label class="form-check-label" for="conformidadNo_pa">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_patrimonizacion_inicio_bs" id="fecha_patrimonizacion_inicio_bs"  onchange="calcularDias('fecha_patrimonizacion_inicio_bs', 'fecha_patrimonizacion_fin_bs', 'patrimonizacion_dias_bs')">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_patrimonizacion_fin_bs" id="fecha_patrimonizacion_fin_bs" onchange="calcularDias('fecha_patrimonizacion_inicio_bs', 'fecha_patrimonizacion_fin_bs', 'patrimonizacion_dias_bs')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="patrimonizacion_dias_bs" id="patrimonizacion_dias_bs" readonly placeholder="Días" >
                            </div>
                        </div> 
                        <div class="row mb-2"><b>Informe de Conformidad <br>(Proyectista)</b></div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" style="align-content: center" type="radio" name="conformidad_proyectista_bs" id="conformidadSi" value="COMPLETADO">
                                        <label class="form-check-label" for="conformidadSi">Sí</label>
                                    </div>
                                    <div class="form-check" >
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadNo" value="CANCELADO">
                                        <label class="form-check-label" for="conformidadNo">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_conformidad_proyectista_inicio_bs" id="f_conformidad_proyectista_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_conformidad_proyectista_inicio_bs', 'f_conformidad_proyectista_fin_bs', 'conformidad_proyectista_dias_bs')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_conformidad_proyectista_fin_bs" id="f_conformidad_proyectista_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_conformidad_proyectista_inicio_bs', 'f_conformidad_proyectista_fin_bs', 'conformidad_proyectista_dias_bs')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="conformidad_proyectista_dias_bs" id="conformidad_proyectista_dias_bs" placeholder="Días" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Envío a SGASA Penalidad</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_SGASA_penalidad_bs">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" name="penalidad_dias_bs" id="penalidad_dias_bs" placeholder="Días" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <div class="checkbox-container mt-2">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioSi" value="SI">
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioNo" value="NO">
                                        <label class="form-check-label" for="envioNo">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2 text-center">
                            <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                            <button type="submit" class="btn btn-success mx-1" onclick="return validarFechaYAgregar()"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //SCRIPT PARA EL SELECT2 Y SELECCINAR UNA INVERSION Y MOSTRAR SUS USUARIOS
    $(document).ready(function() {
    // Ejecutar cuando el modal se muestra
    $('#ModalCreateBien').on('shown.bs.modal', function () {
        // Inicializar select2 en el select de inversión
        $('#idInversion-create_bs').select2({
            placeholder: "Selecciona una inversión",
            allowClear: true,
            width: '100%', 
            language: {
                noResults: function() {
                    return "No se encontró la inversión";
                }
            },
            dropdownParent: $('#ModalCreateBien')
        });
        // Añadir el event listener al select de inversión solo una vez
        if (!$('#idInversion-create_bs').data('listener-added')) {
            // Evento para manejar el cambio de selección en el select de inversión
            $('#idInversion-create_bs').on('change', function() {
                const inversionId = this.value; // Obtener el ID de la inversión seleccionada
                const usuariosSelect = document.getElementById('usuariosSelect-create_bs'); // Obtener el select de usuarios
                usuariosSelect.innerHTML = '<option value="" disabled selected>Selecciona un usuario</option>'; // Limpiar el select de usuarios
                // Realizar una solicitud fetch para obtener los usuarios según la inversión seleccionada
                fetch(`/usuarios-por-bienes/${inversionId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta de la red');
                        }
                        return response.json();
                    })
                    .then(usuarios => {
                        usuarios.forEach(usuario => {
                            const option = document.createElement('option');
                            option.value = usuario.idUsuario;
                            // Construir el texto del option con profesiones y especialidades
                            const profesiones = usuario.profesiones.map(p => p.nombreProfesion).join(', ');
                            const especialidades = usuario.especialidades.map(e => e.nombreEspecialidad).join(', ');
                            option.innerHTML = `${usuario.nombreUsuario} ${usuario.apellidoUsuario} => P: (${profesiones}) &nbsp; | &nbsp; E: (${especialidades})`;
                            usuariosSelect.appendChild(option); // Añadir el option al select de usuarios
                        });
                    })
                    .catch(error => console.error('Error al cargar los usuarios:', error));
            });
            $('#idInversion-create_bs').data('listener-added', true); // Marcar el event listener como añadido
        }
    });
    // Destruir el select2 en el select de inversión cuando se cierra el modal
    $('#ModalCreateBien').on('hidden.bs.modal', function () {
        $('#idInversion-create_bs').select2('destroy');
    });
});

</script>
<script>
    //SCRIPT PARA CALCULAR LAS FECHAS
    function calcularDias(inicioId, finId, diasId) {
    const fechaInicio = document.getElementById(inicioId).value;
    const fechaFin = document.getElementById(finId).value;
    const diasInput = document.getElementById(diasId);
    
    if (fechaInicio && fechaFin) {
        const inicio = new Date(fechaInicio);
        const fin = new Date(fechaFin);
        const diferencia = fin - inicio;
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));

        diasInput.value = dias >= 0 ? dias : 0;
        calcularFechaPlazoEjecucion();
    } else {
        diasInput.value = '';
    }
}

function calcularFechaPlazoEjecucion() {
    const fechaNotificacionFin = document.getElementById('f_notificacion_fin_bs').value;
    const plazoEjecucionDias = parseInt(document.getElementById('plazo_bs').value, 10);
    const notificacionDias = parseInt(document.getElementById('notificacion_dias_bs').value, 10); // Obtener los días de notificación
    const fechaPlazoEjecucionInput = document.getElementById('fecha_plazo_ejecucion_bs');

    if (fechaNotificacionFin && plazoEjecucionDias && !isNaN(notificacionDias)) {
        const fechaFin = new Date(fechaNotificacionFin);

        // Sumar los días de notificación + días de ejecución
        fechaFin.setDate(fechaFin.getDate() + notificacionDias + plazoEjecucionDias);

        const nuevaFecha = fechaFin.toISOString().split('T')[0];
        fechaPlazoEjecucionInput.value = nuevaFecha;
        calcularFechaAmpliacionPlazo();
    } else {
        fechaPlazoEjecucionInput.value = '';
    }
}

function calcularFechaAmpliacionPlazo() {
    const fechaPlazoEjecucion = document.getElementById('fecha_plazo_ejecucion_bs').value;
    const ampliacionPlazoDias = parseInt(document.getElementById('ampliacionPlazo_bs').value, 10);
    const fechaAmpliacionPlazoInput = document.getElementById('fecha_ampliacion_plazo_bs');

    if (fechaPlazoEjecucion && ampliacionPlazoDias) {
        const fechaPlazo = new Date(fechaPlazoEjecucion);
        fechaPlazo.setDate(fechaPlazo.getDate() + ampliacionPlazoDias);

        const nuevaFechaAmpliacion = fechaPlazo.toISOString().split('T')[0];
        fechaAmpliacionPlazoInput.value = nuevaFechaAmpliacion;
    } else {
        fechaAmpliacionPlazoInput.value = '';
    }
}
//A;ADIR UN CONTENDDOR DE OBSERVACION
function addObservaciones() {
    const container = document.getElementById('observacion-container_bs');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <div class="input-group mb-2">
            <textarea class="form-control input-auth observacion-input" rows="3"></textarea>
            <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
        </div>
    `;
    container.appendChild(div);
}

function removeElement(element) {
    element.parentNode.remove();
}

// Concatenar observaciones antes de enviar el formulario
document.getElementById('mi-formulario_bs').addEventListener('submit', function(event) {
    const observacionesInputs = document.querySelectorAll('.observacion-input');
    let observacionesFinal = '';

    observacionesInputs.forEach((textarea, index) => {
        if (textarea.value.trim() !== '') {
            observacionesFinal += textarea.value.trim() + '\n';
        }
    });

    // Guardar todas las observaciones concatenadas en el input oculto
    document.getElementById('observaciones-final_bs').value = observacionesFinal;
});

</script>
<script>
    function validarFechaYAgregar() {
    // Obtener los valores de los campos
    var fechaNotificacionInicio = document.getElementById('f_notificacion_inicio_bs').value;
    var fechaNotificacionFin = document.getElementById('f_notificacion_fin_bs').value;
    var plazoDias = document.getElementById('plazo_bs').value;
    var ampliacionPlazoDias = document.getElementById('ampliacionPlazo_bs').value;
    var fechaPlazoEjecucion = document.getElementById('fecha_plazo_ejecucion_bs');
    var fechaAmpliacionPlazo = document.getElementById('fecha_ampliacion_plazo_bs');

    // Convertir el valor de plazo y ampliación de plazo en números para manejar correctamente (0 será tratado como vacío)
    plazoDias = parseInt(plazoDias);
    ampliacionPlazoDias = parseInt(ampliacionPlazoDias);

    // Validar si ambos campos de fecha de notificación están vacíos y el plazo es 0
    if ((!plazoDias && plazoDias !== 0) && !fechaNotificacionInicio && !fechaNotificacionFin) {
        return true;  // No mostrar alerta, continuar normalmente
    }

    // Validar si el plazo tiene un valor pero faltan fechas de notificación
    if (plazoDias) {
        if (!fechaNotificacionInicio) {
            alert('Por favor, ingrese una fecha de notificación de inicio antes de agregar el plazo.');
            document.getElementById('plazo_bs').value = 0;
            fechaPlazoEjecucion.value = '';  // Limpiar el campo fecha_plazo_ejecucion_bs
            return false;
        }
        if (!fechaNotificacionFin) {
            alert('Por favor, ingrese una fecha de notificación de fin antes de agregar el plazo.');
            document.getElementById('plazo_bs').value = 0;
            fechaPlazoEjecucion.value = '';  // Limpiar el campo fecha_plazo_ejecucion_bs
            return false;
        }
    }

    // Validar si el campo de ampliación de plazo tiene un valor pero falta la fecha de plazo de ejecución
    if (ampliacionPlazoDias > 0 && !fechaPlazoEjecucion.value) {
        alert('Por favor, seleccione una fecha de plazo de ejecución antes de agregar una ampliación de plazo.');
        document.getElementById('ampliacionPlazo_bs').value = 0;
        fechaAmpliacionPlazo.value = '';  // Restablecer el campo de ampliación a 0
        return false;
    }
    // Si todo está bien, permitir la acción
    return true;
}
</script>
<script>
    // Seleccionar el checkbox y el div
    const extenderPlazo_bs = document.getElementById('extenderPlazo_bs');
    const ampliacion_bs = document.getElementById('ampliacion_bs');
  
    // Añadir un listener para el evento 'change'
    extenderPlazo_bs.addEventListener('change', function() {
      if (this.checked) {
        ampliacion_bs.style.display = 'block';
      } else {
        ampliacion_bs.style.display = 'none';
      }
    });
  </script>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered { 
        line-height: 24px;
        padding-left: 10px; /* Ajustar el padding izquierdo */
         /* Asegurar que el texto esté alineado a la izquierda */
    }
    .select2-container .select2-selection--single {
        height: 35px;
        padding-left: 0px; /* Ajustar el padding izquierdo */
    }
    .select2-container .select2-dropdown {
          z-index: 9999;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable  {
          background-color: #9C0C27 !important; /* Cambia este color al que desees */
          color: rgb(248, 243, 243) !important;/* Cambia el color del texto si es necesario */
    }
    .date-input {
        width: 20px;
    }
    .checkbox-container {
        display: flex;
        align-items: center;
    }
    .proceso-fecha {
        flex: 1;
    }
    .proceso-dias {
        width: 100px;
    }
</style>
<style>
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
    /* Redirection */
    @media (max-width: 991.98px) {
      .cascading-left {
        margin-left: 0px;
      }
      section {
        margin-top: 0px;
      }
    }
  </style>