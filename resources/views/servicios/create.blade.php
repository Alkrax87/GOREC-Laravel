<form id="mi-formulario" action="{{ route('servicios.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCreate">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-wrench"></i> Crear Servicios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-7">
                                <label class="form-label">Inversión</label>
                                <select name="idInversion" id="idInversion-create" class="form-select form-select-sm input-auth" required>
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
                                        <select name="idUsuario" class="form-select form-select-sm input-auth" required id="usuariosSelect-create">
                                            <option value="" disabled selected>Selecciona un usuario</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nombreServicio" class="form-label">Nombre Servicio</label>
                            <input type="text" class="form-control input-auth" name="nombre_servicio" id="nombreServicio" placeholder="Ingrese Servicio" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="meta" class="form-label">Meta</label>
                                <input type="text"  name="meta" class="form-control input-auth" id="meta" placeholder="Ingrese Meta" required>
                            </div>
                            <div class="col-6">
                                <label for="siaf" class="form-label">SIAF (llenar posterior, no obligatorio)</label>
                                <input type="text" name="siaf" class="form-control input-auth" placeholder="Ingrese SIAF" id="siaf">
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
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-3"><b>Fecha Inicio</b></div>
                            <div class="col-3"><b>Fecha Fin</b></div>
                            <div class="col-2"><b>Cant. Dias</b></div>
                        </div>
                        <div class="row mb-2"><b>Presentación de Requerimiento</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="text"  name="nombre_requerimientos" class="form-control input-auth" id="nombre_requerimientos" placeholder="Ingrese Requerimiento" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_presentacion_req_inicio" id="f_presentacion_req_inicio" onchange="calcularDias('f_presentacion_req_inicio', 'f_presentacion_req_fin', 'presentacion_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_presentacion_req_fin" id="f_presentacion_req_fin" onchange="calcularDias('f_presentacion_req_inicio', 'f_presentacion_req_fin', 'presentacion_dias')">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="presentacion_dias"  id="presentacion_dias" readonly placeholder="Días" >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Designación de Cotizador</b></div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <input type="text"  name="nombre_cotizador" class="form-control input-auth" id="nombre_cotizador" placeholder="Ingrese Cotizador" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_designacion_cotizador_inicio" id="f_designacion_cotizador_inicio" onchange="calcularDias('f_designacion_cotizador_inicio', 'f_designacion_cotizador_fin', 'designacion_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_designacion_cotizador_fin" id="f_designacion_cotizador_fin" onchange="calcularDias('f_designacion_cotizador_inicio', 'f_designacion_cotizador_fin', 'designacion_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-dias" name="designacion_dias" id="designacion_dias" readonly placeholder="Días" >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Estudio de Mercado</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_estudio_mercado_inicio" id="f_estudio_mercado_inicio" onchange="calcularDias('f_estudio_mercado_inicio', 'f_estudio_mercado_fin', 'estudiomercado_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_estudio_mercado_fin" id="f_estudio_mercado_fin" onchange="calcularDias('f_estudio_mercado_inicio', 'f_estudio_mercado_fin', 'estudiomercado_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="estudiomercado_dias" id="estudiomercado_dias" readonly placeholder="Días" >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><b>Cuadro Comparativo</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cuadro_comparativo_inicio" id="f_cuadro_comparativo_inicio" onchange="calcularDias('f_cuadro_comparativo_inicio', 'f_cuadro_comparativo_fin', 'cuadro_comparativo_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_cuadro_comparativo_fin" id="f_cuadro_comparativo_fin" onchange="calcularDias('f_cuadro_comparativo_inicio', 'f_cuadro_comparativo_fin', 'cuadro_comparativo_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="cuadro_comparativo_dias" id="cuadro_comparativo_dias" readonly placeholder="Días">
                            </div>
                        </div>
                        <div class="row mb-2"><b>Nº de Certificación</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="number"  name="numero_certificacion" class="form-control input-auth" id="numero_certificacion" placeholder="Ingrese Nº" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_certificacion_inicio" id="f_numero_certificacion_inicio" onchange="calcularDias('f_numero_certificacion_inicio', 'f_numero_certificacion_fin', 'numero_certificacion_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_numero_certificacion_fin" id="f_numero_certificacion_fin" onchange="calcularDias('f_numero_certificacion_inicio', 'f_numero_certificacion_fin', 'numero_certificacion_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="numero_certificacion_dias" id="numero_certificacion_dias" placeholder="Días" readonly >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Orden de Servicio / Contrato</b></div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="number"  name="numero_orden" class="form-control input-auth" id="numero_orden" placeholder="Ingrese Nº" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_orden_servicio_inicio" id="f_orden_servicio_inicio" placeholder="F. Inicio" onchange="calcularDias('f_orden_servicio_inicio', 'f_orden_servicio_fin', 'orden_servicio_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_orden_servicio_fin" id="f_orden_servicio_fin" placeholder="F. Fin" onchange="calcularDias('f_orden_servicio_inicio', 'f_orden_servicio_fin', 'orden_servicio_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="orden_servicio_dias" id="orden_servicio_dias" placeholder="Días" readonly >
                            </div>
                        </div>
                        <div class="row mb-2"><b>Notificación</b></div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="checkbox-container pt-2">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="email_presencial" id="email" value="Email">
                                        <label class="form-check-label" for="email">Email</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="email_presencial" id="presencial" value="Presencial">
                                        <label class="form-check-label" for="presencial">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_notificacion_inicio" id="f_notificacion_inicio" placeholder="F. Inicio" onchange="calcularDias('f_notificacion_inicio', 'f_notificacion_fin', 'notificacion_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_notificacion_fin" id="f_notificacion_fin" placeholder="F. Fin" onchange="calcularDias('f_notificacion_inicio', 'f_notificacion_fin', 'notificacion_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="notificacion_dias" id="notificacion_dias" placeholder="Días" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Plazo de Ejecución (Días):</b></div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" name="plazo_ejecucion_dias" id="plazo" onchange="calcularFechaPlazoEjecucion()" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_plazo_ejecucion" id="fecha_plazo_ejecucion" readonly >
                            </div>
                            <div class="col-3">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="extenderPlazo" >
                                    <label class="form-check-label" for="extenderPlazo">
                                        Extender Plazo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="crearCuenta" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-outline mb-2">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">Ampliación de Plazo (Días)</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="ampliacion_plazo_dias" class="form-control input-auth" id="ampliacionPlazo" onchange="calcularFechaAmpliacionPlazo()" min="0" oninput="this.value = Math.abs(this.value)">
                                            </div>
                                            <div class="col-3">
                                                <input type="date" name="fecha_ampliacion_plazo" class="form-control input-auth" id="fecha_ampliacion_plazo" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label for="observaciones" class="form-label">Observaciones</label>
                                        <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservaciones()"><i class="fas fa-plus"></i></button>
                                        <div id="observacion-container">
                                            <div class="input-group mb-2">
                                                <textarea class="form-control observacion-input" rows="3"></textarea>
                                                <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="observaciones" id="observaciones-final">
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="desestimiento" class="form-label">Carta de Desestimiento</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" name="fecha_carta_desestimiento" class="form-control input-auth">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Entrega del Producto</b></div>
                            <div class="col-3">
                                <input type="date" name="f_entrega_producto" class="form-control input-auth" >
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <div class="col-4"><b>Retorno a SGEP(Sub Gerencia)</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_retorno_SGEP_inicio" id="f_retorno_SGEP_inicio" onchange="calcularDias('f_retorno_SGEP_inicio', 'f_retorno_SGEP_fin', 'retorno_SGEP_dias')" >
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="f_retorno_SGEP_fin" id="f_retorno_SGEP_fin" onchange="calcularDias('f_retorno_SGEP_inicio', 'f_retorno_SGEP_fin', 'retorno_SGEP_dias')" >
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth proceso-fecha" name="retorno_SGEP_dias" id="retorno_SGEP_dias" readonly placeholder="Días" >
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <div class="col-4"><b>Deriva a Proyectista</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_derivar_proyectista"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Informe de Conformidad</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_informe_conformidad"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Deriva a la SGEP (Administración)</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_SGEP_administracion" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Conformidad</b></div>
                            <div class="col-3">
                                <div class="checkbox-container">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad" id="conformidadSi" value="COMPLETADO">
                                        <label class="form-check-label" for="conformidadSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad" id="conformidadNo" value="CANCELADO">
                                        <label class="form-check-label" for="conformidadNo">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4"><b>Envío a SGASA Penalidad:</b></div>
                            <div class="col-3">
                                <input type="date" class="form-control input-auth proceso-fecha" name="fecha_SGASA_penalidad">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-auth" name="penalidad_dias" id="penalidad_dias" placeholder="Días" min="0" oninput="this.value = Math.abs(this.value)">
                            </div>
                            <div class="col-3">
                                <div class="checkbox-container pt-2">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio" id="envioSi" value="SI">
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envio" id="envioNo" value="NO">
                                        <label class="form-check-label" for="envioNo">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2 text-center">
                            <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                            <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
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
    $('#ModalCreate').on('shown.bs.modal', function () {
        // Inicializar select2 en el select de inversión
        $('#idInversion-create').select2({
            placeholder: "Selecciona una inversión",
            allowClear: true,
            width: '100%', 
            language: {
                noResults: function() {
                    return "No se encontró la inversión";
                }
            }
        });
        // Añadir el event listener al select de inversión solo una vez
        if (!$('#idInversion-create').data('listener-added')) {
            // Evento para manejar el cambio de selección en el select de inversión
            $('#idInversion-create').on('change', function() {
                const inversionId = this.value; // Obtener el ID de la inversión seleccionada
                const usuariosSelect = document.getElementById('usuariosSelect-create'); // Obtener el select de usuarios
                usuariosSelect.innerHTML = '<option value="" disabled selected>Selecciona un usuario</option>'; // Limpiar el select de usuarios
                // Realizar una solicitud fetch para obtener los usuarios según la inversión seleccionada
                fetch(`/usuarios-por-servicios/${inversionId}`)
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
            $('#idInversion-create').data('listener-added', true); // Marcar el event listener como añadido
        }
    });
    // Destruir el select2 en el select de inversión cuando se cierra el modal
    $('#ModalCreate').on('hidden.bs.modal', function () {
        $('#idInversion-create').select2('destroy');
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
    const fechaNotificacionFin = document.getElementById('f_notificacion_fin').value;
    const plazoEjecucionDias = parseInt(document.getElementById('plazo').value, 10);
    const notificacionDias = parseInt(document.getElementById('notificacion_dias').value, 10); // Obtener los días de notificación
    const fechaPlazoEjecucionInput = document.getElementById('fecha_plazo_ejecucion');

    if (fechaNotificacionFin && plazoEjecucionDias && !isNaN(notificacionDias)) {
        const fechaFin = new Date(fechaNotificacionFin);

        // Sumar los días de notificación + días de ejecución
        fechaFin.setDate(fechaFin.getDate() + notificacionDias + plazoEjecucionDias);

        const nuevaFecha = fechaFin.toISOString().split('T')[0];
        fechaPlazoEjecucionInput.value = nuevaFecha;
    } else {
        fechaPlazoEjecucionInput.value = '';
    }
}

function calcularFechaAmpliacionPlazo() {
    const fechaPlazoEjecucion = document.getElementById('fecha_plazo_ejecucion').value;
    const ampliacionPlazoDias = parseInt(document.getElementById('ampliacionPlazo').value, 10);
    const fechaAmpliacionPlazoInput = document.getElementById('fecha_ampliacion_plazo');

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
    const container = document.getElementById('observacion-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <div class="input-group mb-2">
            <textarea class="form-control observacion-input" rows="3"></textarea>
            <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
        </div>
    `;
    container.appendChild(div);
}

function removeElement(element) {
    element.parentNode.remove();
}

// Concatenar observaciones antes de enviar el formulario
document.getElementById('mi-formulario').addEventListener('submit', function(event) {
    const observacionesInputs = document.querySelectorAll('.observacion-input');
    let observacionesFinal = '';

    observacionesInputs.forEach((textarea, index) => {
        if (textarea.value.trim() !== '') {
            observacionesFinal += textarea.value.trim() + '\n';
        }
    });

    // Guardar todas las observaciones concatenadas en el input oculto
    document.getElementById('observaciones-final').value = observacionesFinal;
});

</script>
<script>
    // Seleccionar el checkbox y el div
    const activarCrearCuenta = document.getElementById('extenderPlazo');
    const crearCuenta = document.getElementById('crearCuenta');
  
    // Añadir un listener para el evento 'change'
    activarCrearCuenta.addEventListener('change', function() {
      if (this.checked) {
        crearCuenta.style.display = 'block';
      } else {
        crearCuenta.style.display = 'none';
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
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .date-input {
        width: 150px;
    }
    .divider {
        border-top: 2px solid black;
        margin: 15px 0;
    }
    .checkbox-container {
        display: flex;
        align-items: center;
    }
    .proceso-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .proceso-label {
        flex: 1;
        font-weight: bold;
    }
    .proceso-fecha {
        flex: 1;
    }
    .proceso-dias {
        width: 100px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .proceso-titulos {
        display: flex;
        align-items: center;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .proceso-titulos div {
        flex: 1;
        text-align: center;
    }
    .titulo-dias {
        width: 100px;
        text-align: center;
    }
</style>
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