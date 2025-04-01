<form action="{{ route('inversion.update', $inversion->idInversion) }}" method="POST" enctype="multipart/form-data">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalEdit{{$inversion->idInversion}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Editar Inversion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <strong>Error!</strong> Por favor corrige los errores en el formulario.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="row">
            <!-- Inputs -->
            @if (Auth::user()->isAdmin)
              <div class="col-12">
                <div class="form-outline mb-4">
                  <label class="form-label">CUI</label>
                  <input type="text" name="cuiInversion" value="{{ $inversion->cuiInversion }}" class="input-auth" placeholder="CUI" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <textarea class="input-auth form-control" name="nombreInversion" placeholder="Nombre Inversión" rows="4" required>{{ $inversion->nombreInversion }}</textarea>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre Corto</label>
                  <input type="text" name="nombreCortoInversion" value="{{ $inversion->nombreCortoInversion }}" class="input-auth" placeholder="Nombre Corto" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Responsable</label>
                  <select name="idUsuario" class="form-select input-auth" required>
                    <option value="" disabled>Selecciona un usuario</option>
                    @foreach ($usuarios as $usuario)
                      <option value="{{ $usuario->idUsuario }}" {{ $inversion->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                        {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                        P: (
                          @if ($usuario->profesiones->isNotEmpty())
                            @foreach ($usuario->profesiones as $profesion)
                              {{ $profesion->nombreProfesion }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                        )
                        &nbsp; | &nbsp;
                        E: (
                          @if ($usuario->especialidades->isNotEmpty())
                            @foreach ($usuario->especialidades as $especialidad)
                              {{ $especialidad->nombreEspecialidad }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                        )
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Coordinadores</label>
                  <button class="btn btn-success btn-sm mb-2" onclick="addMoreCoordinadores()">
                    <i class="fas fa-plus"></i>
                  </button>
                  <div id="coordinadoresContainer{{ $inversion->idInversion }}">
                    @foreach ($inversion->coordinadores as $coordinador)
                      <div class="input-group mb-2">
                        <select name="idCoordinador[]" id="usuariosSelect" class="form-select input-auth" required>
                          <option value="" disabled>Selecciona un usuario</option>
                          @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->idUsuario }}" {{ $usuario->idUsuario == $coordinador->idUsuario ? 'selected' : '' }}>
                              {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                              P: (
                                @if ($usuario->profesiones->isNotEmpty())
                                  @foreach ($usuario->profesiones as $profesion)
                                    {{ $profesion->nombreProfesion }}
                                    @if (!$loop->last)
                                      ,
                                    @endif
                                  @endforeach
                                @endif
                              )
                              &nbsp; | &nbsp;
                              E: (
                                @if ($usuario->especialidades->isNotEmpty())
                                  @foreach ($usuario->especialidades as $especialidad)
                                    {{ $especialidad->nombreEspecialidad }}
                                    @if (!$loop->last)
                                      ,
                                    @endif
                                  @endforeach
                                @endif
                              )
                            </option>
                          @endforeach
                        </select>
                        <button type="button" class="btn btn-danger btn-sm {{ $loop->first ? 'disabled' : '' }}" onclick="removeCoordinador(this)">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="row form-outline mb-4">
                  <div class="col-6">
                    <label class="form-label">Provincia</label>
                    <select name="provinciaInversion" id="provinciaInversionEdit{{$inversion->idInversion}}" class="form-select input-auth" required>
                      <option value="" disabled>Selecciona una provincia</option>
                      @foreach ($provincias as $provincia)
                        <option value="{{ $provincia['nombre'] }}" data-distritos="{{ json_encode($provincia['distritos']) }}" {{ $provincia['nombre'] == $inversion->provinciaInversion ? 'selected' : '' }}>
                          {{ $provincia['nombre'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Distrito</label>
                    <select name="distritoInversion" id="distritoInversionEdit{{$inversion->idInversion}}" class="form-select input-auth" required>
                      <option value="" disabled>Selecciona un distrito</option>
                      @if($inversion->provinciaInversion)
                        @foreach ($provincias as $provincia)
                          @if ($provincia['nombre'] == $inversion->provinciaInversion)
                            @foreach ($provincia['distritos'] as $distrito)
                              <option value="{{ $distrito }}" {{ $distrito == $inversion->distritoInversion ? 'selected' : '' }}>
                                {{ $distrito }}
                              </option>
                            @endforeach
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="row form-outline mb-4">
                  <div class="col-4">
                    <label class="form-label">Nivel</label>
                    <select name="nivelInversion" class="form-select input-auth" required>
                      <option value="" disabled selected>Selecciona un nivel</option>
                      <option value="EXPEDIENTE TÉCNICO" {{ $inversion->nivelInversion == 'EXPEDIENTE TÉCNICO' ? 'selected' : '' }}>EXPEDIENTE TÉCNICO</option>
                      <option value="IOARR" {{ $inversion->nivelInversion == 'IOARR' ? 'selected' : '' }}>IOARR</option>
                    </select>
                  </div>
                  <div class="col-8">
                    <label class="form-label">Función</label>
                    <select name="funcionInversion" id="funcionInversion" class="form-select input-auth" required>
                      <option value="" disabled selected>Selecciona una función</option>
                      <option value="PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA" {{ $inversion->funcionInversion == 'PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA' ? 'selected' : '' }}>PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA</option>
                      <option value="JUSTICIA" {{ $inversion->funcionInversion == 'JUSTICIA' ? 'selected' : '' }}>JUSTICIA</option>
                      <option value="TRANSPORTE" {{ $inversion->funcionInversion == 'TRANSPORTE' ? 'selected' : '' }}>TRANSPORTE</option>
                      <option value="SANEAMIENTO" {{ $inversion->funcionInversion == 'SANEAMIENTO' ? 'selected' : '' }}>SANEAMIENTO</option>
                      <option value="SALUD" {{ $inversion->funcionInversion == 'IOARR' ? 'SALUD' : '' }}>SALUD</option>
                      <option value="EDUCACIÓN" {{ $inversion->funcionInversion == 'IOARR' ? 'EDUCACIÓN' : '' }}>EDUCACIÓN</option>
                    </select>
                  </div>
                </div>
                <div class="row form-outline mb-4">
                  <div class="col-12">
                    <label class="form-label">Modalidad</label>
                    <select name="modalidadInversion" class="form-select input-auth" required>
                      <option value="" disabled selected>Selecciona una modalidad</option>
                      <option value="DIRECTA" {{ $inversion->modalidadInversion == 'DIRECTA' ? 'selected' : '' }}>DIRECTA</option>
                      <option value="CONTRATA" {{ $inversion->modalidadInversion == 'CONTRATA' ? 'selected' : '' }}>CONTRATA</option>
                    </select>
                  </div>
                </div>
                <div class="row form-outline mb-4">
                  <div class="col-6">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fechaInicioInversion" value="{{ $inversion->fechaInicioInversion }}" class="input-auth" required/>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Fecha Final</label>
                    <input type="date" name="fechaFinalInversion" value="{{ $inversion->fechaFinalInversion }}" class="input-auth" required/>
                  </div>
                </div>
                <div class="row form-outline mb-4">
                  <div class="col-6">
                    <label class="form-label">Presupuesto Formulación</label>
                    <div class="input-group">
                      <span class="input-group-text bg-secondary">S/</span>
                      <input type="text" name="presupuestoFormulacionInversion" value="{{ $inversion->presupuestoFormulacionInversion }}" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Formulación" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Presupuesto Ejecución</label>
                    <div class="input-group">
                      <span class="input-group-text bg-secondary">S/</span>
                      <input type="text" name="presupuestoEjecucionInversion" value="{{ $inversion->presupuestoEjecucionInversion }}" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Ejecución" required>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label class="form-label">Archivo</label>
                  <input type="file" name="archivoInversion" accept="application/pdf" class="form-control" id="archivoInversionedit{{ $inversion->idInversion }}">
                  @if ($inversion->archivoInversion)
                    <p class="text-danger my-2">Ya existe un archivo vinculado a esta Inversión.</p>
                    <div class="row">
                      <div class="col">
                        <a href="{{ route('inversion.download', $inversion->idInversion) }}" class="btn btn-dark">
                          <i class="fas fa-file-download"></i>&nbsp;&nbsp; Descargar archivo actual
                        </a>
                      </div>
                      <div class="col">
                        <div class="form-check mt-2">
                          <input type="checkbox" class="form-check-input" id="deleteFile" value="1" name="deleteFile">
                          <label class="form-check-label" for="deleteFile">Eliminar archivo actual</label>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            @endif
            <div class="form-outline mb-4">
              <label class="form-label">Estado</label>
              <select name="estadoInversion" class="form-select input-auth" required>
                <option value="" disabled selected>Selecciona una estado</option>
                <option value="POR ELABORAR" {{ $inversion->estadoInversion == 'POR ELABORAR' ? 'selected' : '' }}>POR ELABORAR</option>
                <option value="PARALIZADO" {{ $inversion->estadoInversion == 'PARALIZADO' ? 'selected' : '' }}>PARALIZADO</option>
                <option value="EN ELABORACIÓN" {{ $inversion->estadoInversion == 'EN ELABORACIÓN' ? 'selected' : '' }}>EN ELABORACIÓN</option>
                <option value="EN GRSLI" {{ $inversion->estadoInversion == 'EN GRSLI' ? 'selected' : '' }}>EN GRSLI</option>
                <option value="EN LEVANTAMIENTO DE OBSERVACIONES" {{ $inversion->estadoInversion == 'EN LEVANTAMIENTO DE OBSERVACIONES' ? 'selected' : '' }}>EN LEVANTAMIENTO DE OBSERVACIONES</option>
                <option value="CON CONFORMIDAD DE GRSLI" {{ $inversion->estadoInversion == 'CON CONFORMIDAD DE GRSLI' ? 'selected' : '' }}>CON CONFORMIDAD DE GRSLI</option>
                <option value="CON REGISTRO DE FASE DE EJECUCIÓN" {{ $inversion->estadoInversion == 'CON REGISTRO DE FASE DE EJECUCIÓN' ? 'selected' : '' }}>CON REGISTRO DE FASE DE EJECUCIÓN</option>
                <option value="CON RESOLUCIÓN EJECUTIVA" {{ $inversion->estadoInversion == 'CON RESOLUCIÓN EJECUTIVA' ? 'selected' : '' }}>CON RESOLUCIÓN EJECUTIVA</option>
              </select>
            </div>
            <h5 class="text-center text-bold mb-1">Conformidad Técnica</h5>
            <div class="row form-outline mb-4">
              <div class="col-6">
                <label class="form-label">Fecha</label>
                <input type="date" name="Fecha_ConformidadTecnica_Inversion" value="{{ $inversion->Fecha_ConformidadTecnica_Inversion }}" class="input-auth" />
              </div>
              <div class="col-6 d-flex flex-column justify-content-end">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="ConformidadTecnica" id="envioSi" value="SI" {{ $inversion->ConformidadTecnica === 'SI' ? 'checked' : '' }}>
                  <label class="form-check-label" for="envioSi">Sí</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="ConformidadTecnica" id="envioNo" value="NO" {{ $inversion->ConformidadTecnica === 'NO' ? 'checked' : '' }}>
                  <label class="form-check-label" for="envioNo">No</label>
                </div>
              </div>
            </div>
            <h5 class="text-center text-bold mb-1">Aprobación de Consistencia</h5>
            <div class="row form-outline mb-4">
              <div class="col-6">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fechaInicioConsistenciaInversion" value="{{ $inversion->fechaInicioConsistenciaInversion }}" class="input-auth"/>
              </div>
              <div class="col-6">
                <label class="form-label">Fecha Final</label>
                <input type="date" name="fechaFinalConsistenciaInversion" value="{{ $inversion->fechaFinalConsistenciaInversion }}" class="input-auth"/>
              </div>
            </div>
            <h5 class="text-center text-bold mb-1">Acto Resolutivo</h5>
            <div class="row form-outline mb-4">
              <div class="col-6">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_ActoResolutivo_Inversion" value="{{ $inversion->fecha_ActoResolutivo_Inversion }}" class="input-auth"/>
              </div>
              <div class="col-6">
                <label class="form-label">URL</label>
                <input type="text" name="ActoResolutivo_URL" value="{{ $inversion->ActoResolutivo_URL }}" class="input-auth" placeholder="Ingrese Url"/>
              </div>
            </div>
            <!-- Buttons -->
            <div class="col-12 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Coordinadores
  function addMoreCoordinadores() {
    const container = document.getElementById('coordinadoresContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    const usuariosSelect = document.getElementById('usuariosSelect');
    const newSelect = usuariosSelect.cloneNode(true);
    newSelect.id = '';
    div.appendChild(newSelect);
    div.innerHTML += `
      <button class="btn btn-danger btn-sm" onclick="removeCoordinador(this)">
        <i class="fas fa-trash-alt"></i>
      </button>`;
    container.appendChild(div);
  }
  function removeCoordinador(element) {
    element.parentNode.remove();
  }

  // Selector ( Provincia - Distrito )
  document.addEventListener('DOMContentLoaded', function () {
    const provinciaSelect = document.getElementById('provinciaInversion');
    const distritoSelect = document.getElementById('distritoInversion');

    provinciaSelect.addEventListener('change', function () {
      const distritos = JSON.parse(this.selectedOptions[0].getAttribute('data-distritos'));
      distritoSelect.innerHTML = '<option value="" disabled selected>Selecciona un distrito</option>';
      distritos.forEach(distrito => {
        const option = document.createElement('option');
        option.value = distrito;
        option.textContent = distrito;
        distritoSelect.appendChild(option);
      });
    });
  });

  // Validación del archivo (tamaño máximo 1MB)
  document.getElementById('archivoInversion').addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.size > 1 * 1024 * 1024) {
      alert('El archivo es mayor a 1 MB. Por favor, selecciona un archivo más pequeño.');
      this.value = ''; 
    }
  });
</script>