<form id="mi-formulario_bs" action="{{ route('bienes.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCreateBien">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-users-cog"></i> Crear Bienes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                            <h3 class="text-center">Bienes</h3>
                               
                    
                                <div class="form-outline mb-4">
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
                    
                                  <div class="form-outline mb-4">
                                    <label class="form-label" for="idUsuario">Proyectistas</label>
                                    <div id="usuarios-container-create">
                                      <div class="input-group mb-2">
                                        <select name="idUsuario" class="form-select form-select-sm input-auth" required id="usuariosSelect-create_bs">
                                          <option value="" disabled selected>Selecciona un usuario</option>
                                          <!-- Aquí se llenarán los usuarios dinámicamente -->
                                        </select>

                                      </div>
                                    </div>
                                  </div>

                                <div class="mb-3">
                                    <label for="nombreServicio" class="form-label">Nombre Bien:</label>
                                    <input type="text" class="form-control" name="nombre_bienes" id="nombreServicio" required>
                                </div>

                                <div class="mb-3">
                                    <label for="meta" class="form-label">Meta:</label>
                                    <input type="text"  name="meta_bienes" class="form-control" id="meta" required>
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
                                        <input type="date" class="form-control proceso-fecha" name="f_presentacion_req_inicio_bs" id="f_presentacion_req_inicio_bs" onchange="calcularDias('f_presentacion_req_inicio_bs', 'f_presentacion_req_fin_bs', 'presentacion_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_presentacion_req_fin_bs" id="f_presentacion_req_fin_bs" onchange="calcularDias('f_presentacion_req_inicio_bs', 'f_presentacion_req_fin_bs', 'presentacion_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="presentacion_dias_bs"  id="presentacion_dias_bs" readonly placeholder="Días" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Designación de Cotizador</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_designacion_cotizador_inicio_bs" id="f_designacion_cotizador_inicio_bs" onchange="calcularDias('f_designacion_cotizador_inicio_bs', 'f_designacion_cotizador_fin_bs', 'designacion_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_designacion_cotizador_fin_bs" id="f_designacion_cotizador_fin_bs" onchange="calcularDias('f_designacion_cotizador_inicio_bs', 'f_designacion_cotizador_fin_bs', 'designacion_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="designacion_dias_bs" id="designacion_dias_bs" readonly placeholder="Días" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Estudio de Mercado</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_estudio_mercado_inicio_bs" id="f_estudio_mercado_inicio_bs" onchange="calcularDias('f_estudio_mercado_inicio_bs', 'f_estudio_mercado_fin_bs', 'estudiomercado_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_estudio_mercado_fin_bs" id="f_estudio_mercado_fin_bs" onchange="calcularDias('f_estudio_mercado_inicio_bs', 'f_estudio_mercado_fin_bs', 'estudiomercado_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="estudiomercado_dias_bs" id="estudiomercado_dias_bs" readonly placeholder="Días" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Cuadro Comparativo</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_cuadro_comparativo_inicio_bs" id="f_cuadro_comparativo_inicio_bs" onchange="calcularDias('f_cuadro_comparativo_inicio_bs', 'f_cuadro_comparativo_fin_bs', 'cuadro_comparativo_diasv')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_cuadro_comparativo_fin_bs" id="f_cuadro_comparativo_fin_bs" onchange="calcularDias('f_cuadro_comparativo_inicio_bs', 'f_cuadro_comparativo_fin_bs', 'cuadro_comparativo_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="cuadro_comparativo_dias_bs" id="cuadro_comparativo_dias_bs" readonly placeholder="Días" required>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Elaboración de Certificación</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_elaboracion_certificado_inicio_bs" id="f_elaboracion_certificado_inicio_bs" onchange="calcularDias('f_elaboracion_certificado_inicio_bs', 'f_elaboracion_certificado_fin_bs', 'elaboracion_certificado_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_elaboracion_certificado_fin_bs" id="f_elaboracion_certificado_fin_bs" onchange="calcularDias('f_elaboracion_certificado_inicio_bs', 'f_elaboracion_certificado_fin_bs', 'elaboracion_certificado_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="elaboracion_certificado_dias_bs" id="elaboracion_certificado_dias_bs" placeholder="Días" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Numero Siaf</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_numero_Siaf_inicio_bs" id="f_numero_Siaf_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_numero_Siaf_inicio_bs', 'f_numero_Siaf_fin_bs', 'numero_Siaf_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_numero_Siaf_fin_bs" id="f_numero_Siaf_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_numero_Siaf_inicio_bs', 'f_numero_Siaf_fin_bs', 'numero_Siaf_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="numero_Siaf_dias_bs" id="numero_Siaf_dias_bs" placeholder="Días" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Orden de Compra</label>
                                        <input type="date" class="form-control proceso-fecha" name="f_orden_compra_inicio_bs" id="f_orden_compra_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_orden_compra_inicio_bs', 'f_orden_compra_fin_bs', 'orden_compra_dias_bs')" required>
                                        <input type="date" class="form-control proceso-fecha" name="f_orden_compra_fin_bs" id="f_orden_compra_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_orden_compra_inicio_bs', 'f_orden_compra_fin_bs', 'orden_compra_dias_bs')" required>
                                        <input type="number" class="form-control proceso-dias" name="orden_compra_dias_bs" id="orden_compra_dias_bs" placeholder="Días" readonly required>
                                    </div>
                                </div>

                                <div class="proceso-row">
                                    <label class="proceso-label">Notificación</label>
                                    <input type="date" class="form-control proceso-fecha" name="f_notificacion_inicio_bs" id="f_notificacion_inicio_bs" placeholder="F. Inicio" onchange="calcularDias('f_notificacion_inicio_bs', 'f_notificacion_fin_bs', 'notificacion_dias_bs')" required>
                                    <input type="date" class="form-control proceso-fecha" name="f_notificacion_fin_bs" id="f_notificacion_fin_bs" placeholder="F. Fin" onchange="calcularDias('f_notificacion_inicio_bs', 'f_notificacion_fin_bs', 'notificacion_dias_bs')" required>
                                    <input type="number" class="form-control proceso-dias" name="notificacion_dias_bs" id="notificacion_dias_bs" placeholder="Días" readonly required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="plazo" class="form-label">Plazo de Ejecución (Días):</label>
                                    <input type="number" class="form-control" name="plazo_ejecucion_dias_bs" id="plazo_bs" style="width: 100px;" onchange="calcularFechaPlazoEjecucion()" required>
                                    <input type="date" class="form-control proceso-fecha" name="fecha_plazo_ejecucion_bs" style="width: 120px;" id="fecha_plazo_ejecucion_bs" readonly required>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="extenderPlazo_bs" >
                                        <label class="form-check-label" for="extenderPlazo_bs">
                                            Extender Plazo
                                        </label>
                                    </div>
                                </div>
                            <div id="ampliacion_bs" class="card" style="display: none;">
                                
                                <div class="mb-3">
                                    <label for="ampliacionPlazo" class="form-label">Ampliación de Plazo (Días):</label>
                                    <input type="number" name="ampliacion_plazo_dias_bs" class="form-control" id="ampliacionPlazo_bs" style="width: 100px;"  onchange="calcularFechaAmpliacionPlazo()">
                                    <input type="date" name="fecha_ampliacion_plazo_bs" class="form-control date-input mt-2" id="fecha_ampliacion_plazo_bs" readonly>
                                </div>
                                
                                    
                                <label for="observaciones_bs" class="form-label">Observaciones:</label>
                                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addObservaciones()"><i class="fas fa-plus"></i></button>
                                
                                <div id="observacion-container_bs">
                                    <div class="input-group mb-2">
                                        <textarea class="form-control observacion-input" rows="3"></textarea>
                                        <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                
                                <!-- Campo oculto para enviar todas las observaciones concatenadas -->
                                <input type="hidden" name="observaciones_bs" id="observaciones-final_bs">
                                
                    
                                <div class="mb-3">
                                    <label for="desestimiento" class="form-label">Carta de Desestimiento:</label>
                                    <input type="date" name="fecha_carta_desestimiento_bs" class="form-control date-input">
                                </div>
                    
                                <div class="divider"></div>
                            </div>
                                <div class="mb-3">
                                    <label for="entregable" class="form-label">Entrega Bien:</label>
                                    <input type="date" name="f_entrega_bien_inicio_bs" class="form-control date-input" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="recepcion" class="form-label">Recepcion Bien:</label>
                                    <input type="date" name="f_recepcion_bien_inicio_bs" class="form-control date-input" required>
                                </div>
                    
                                <div class="form-group">
                                    <div class="proceso-row">
                                        <label class="proceso-label">Patrimonizacion</label>
                                        <input type="date" class="form-control proceso-fecha" name="fecha_patrimonizacion_bs"  required>
                                    </div>
                                </div>
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="conformidad" class="form-label me-2">Conformidad Patrimonizacion:</label>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadSi_pa" value="COMPLETADO">
                                        <label class="form-check-label" for="conformidadSi_pa">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad_patrimonizacion_bs" id="conformidadNo_pa" value="CANCELADO">
                                        <label class="form-check-label" for="conformidadNo_pa">No</label>
                                    </div>
                                </div>
                    
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="conformidad" class="form-label me-2">Informe de Conformidad(Proyectista):</label>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadSi" value="COMPLETADO">
                                        <label class="form-check-label" for="conformidadSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="conformidad_proyectista_bs" id="conformidadNo" value="CANCELADO">
                                        <label class="form-check-label" for="conformidadNo">No</label>
                                    </div>
                                </div>
                    
                                <div class="mb-3 checkbox-container">
                                    <label for="penalidad_bs" class="form-label me-2">Envío a SGASA Penalidad:</label>
                                    <div class="form-check me-2">
                                        <input type="date" class="form-control proceso-fecha" name="fecha_SGASA_penalidad_bs">
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioSi" value="SI">
                                        <label class="form-check-label" for="envioSi">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envio_bs" id="envioNo" value="NO">
                                        <label class="form-check-label" for="envioNo">No</label>
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
    $('#ModalCreateBien').on('shown.bs.modal', function () {
        // Inicializar select2 en el select de inversión
        $('#idInversion-create_bs').select2({
            placeholder: "Selecciona una inversión",
            allowClear: true,
            language: {
                noResults: function() {
                    return "No se encontró la inversión";
                }
            }
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