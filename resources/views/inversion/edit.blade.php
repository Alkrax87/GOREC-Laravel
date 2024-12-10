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
            @if (Auth::user()->isAdmin)
              <div class="col-12">
                <div class="form-outline mb-4">
                  <label class="form-label">CUI</label>
                  <input type="text" name="cuiInversion" value="{{ $inversion->cuiInversion }}" class="input-auth" placeholder="CUI" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <textarea class="form-control input-auth" name="nombreInversion" placeholder="Nombre Inversión" rows="4" required>{{ $inversion->nombreInversion }}</textarea>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre Corto</label>
                  <input type="text" name="nombreCortoInversion" value="{{ $inversion->nombreCortoInversion }}" class="input-auth" placeholder="Nombre Corto" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="idUsuario">Responsable</label>
                  <select name="idUsuario" id="idUsuarios{{$inversion->idInversion}}" class="form-select form-select-sm input-auth" required>
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
                  <label class="form-label" for="idCordinador">Coordinador</label>
                  <select name="idCordinador" id="idCordinador{{$inversion->idInversion}}" class="form-select form-select-sm input-auth" required>
                    <option value="" disabled>Selecciona un usuario</option>
                    @foreach ($usuarios as $usuario)
                      <option value="{{ $usuario->idUsuario }}" {{ $inversion->idCordinador == $usuario->idUsuario ? 'selected' : '' }}>
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
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="provinciaInversion">Provincia</label>
                    <select name="provinciaInversion" id="provinciaInversionEdit{{$inversion->idInversion}}" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled>Selecciona una provincia</option>
                      @foreach ($provincias as $provincia)
                        <option value="{{ $provincia['nombre'] }}" data-distritos="{{ json_encode($provincia['distritos']) }}" {{ $provincia['nombre'] == $inversion->provinciaInversion ? 'selected' : '' }}>
                          {{ $provincia['nombre'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="distritoInversion">Distrito</label>
                    <select name="distritoInversion" id="distritoInversionEdit{{$inversion->idInversion}}" class="form-select form-select-sm input-auth" required>
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
                <div class="row">
                  <div class="col-4 form-outline mb-4">
                    <label class="form-label">Nivel</label>
                    <select name="nivelInversion" id="nivelInversion" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona un nivel</option>
                      <option value="EXPEDIENTE TÉCNICO" {{ $inversion->nivelInversion == 'EXPEDIENTE TÉCNICO' ? 'selected' : '' }}>EXPEDIENTE TÉCNICO</option>
                      <option value="IOARR" {{ $inversion->nivelInversion == 'IOARR' ? 'selected' : '' }}>IOARR</option>
                    </select>
                  </div>
                  <div class="col-8 form-outline mb-4">
                    <label class="form-label">Función</label>
                    <select name="funcionInversion" id="funcionInversion" class="form-select form-select-sm input-auth" required>
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
                <div class="col-12 form-outline mb-4">
                  <label class="form-label" for="modalidadInversion">Modalidad</label>
                  <select name="modalidadInversion" id="modalidadInversion" class="form-select form-select-sm input-auth" required>
                    <option value="" disabled selected>Selecciona una modalidad</option>
                    <option value="DIRECTA" {{ $inversion->modalidadInversion == 'DIRECTA' ? 'selected' : '' }}>DIRECTA</option>
                    <option value="CONTRATA" {{ $inversion->modalidadInversion == 'CONTRATA' ? 'selected' : '' }}>CONTRATA</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fechaInicioInversion" value="{{ $inversion->fechaInicioInversion }}" class="input-auth" required/>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Fecha Final</label>
                    <input type="date" name="fechaFinalInversion" value="{{ $inversion->fechaFinalInversion }}" class="input-auth" required/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 form-outline">
                    <label class="form-label">Presupuesto Formulación</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">S/</span>
                      <input type="text" name="presupuestoFormulacionInversion" value="{{ $inversion->presupuestoFormulacionInversion }}" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Formulación" required>
                    </div>
                  </div>
                  <div class="col-6 form-outline">
                    <label class="form-label">Presupuesto Ejecución</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">S/</span>
                      <input type="text" name="presupuestoEjecucionInversion" value="{{ $inversion->presupuestoEjecucionInversion }}" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Ejecución" required>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="archivoInversion">Archivo</label>
                  <input type="file" name="archivoInversion" accept="application/pdf" class="form-control" id="archivoInversionedit{{ $inversion->idInversion }}">
                  @if ($inversion->archivoInversion)
                    <p class="text-danger mb-0">Ya existe un archivo vinculado a esta Inversión.</p>
                    <a href="{{ route('inversion.download', $inversion->idInversion) }}" class="btn btn-dark">
                      <i class="fas fa-file-download"></i>&nbsp;&nbsp; Descargar archivo actual
                    </a>
                    <div class="form-check mt-2">
                      <input type="checkbox" class="form-check-input" id="deleteFile" value="1" name="deleteFile">
                      <label class="form-check-label" for="deleteFile">Eliminar archivo actual</label>
                    </div>
                  @endif
                </div>
              </div>
              <hr>
            @endif
            <div class="col-12 form-outline mb-4">
              <label class="form-label" for="estadoInversion">Estado</label>
              <select name="estadoInversion" id="estadoInversion" class="form-select form-select-sm input-auth" required>
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
            <div class="col-12">
              <h6 class="text-center">Conformidad Técnica</h6>
              <div class="row align-items-center">
                <!-- FECHA -->
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha</label>
                  <input type="date" name="Fecha_ConformidadTecnica_Inversion" value="{{ $inversion->Fecha_ConformidadTecnica_Inversion }}" class="input-auth" />
                </div>
                <!-- SI / NO / EN ESPERA -->
                <div class="col-6 d-flex align-items-center">
                  <div class="form-check me-4">
                    <input class="form-check-input" type="radio" name="ConformidadTecnica" id="envioSi" value="SI" {{ $inversion->ConformidadTecnica === 'SI' ? 'checked' : '' }}>
                    <label class="form-check-label" for="envioSi">Sí</label>
                  </div>
                  <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="ConformidadTecnica" id="envioNo" value="NO" {{ $inversion->ConformidadTecnica === 'NO' ? 'checked' : '' }}>
                    <label class="form-check-label" for="envioNo">No</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <h6 class="text-center">Aprobación de Consistencia</h6>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioConsistenciaInversion" value="{{ $inversion->fechaInicioConsistenciaInversion }}" class="input-auth"/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalConsistenciaInversion" value="{{ $inversion->fechaFinalConsistenciaInversion }}" class="input-auth" />
                </div>
              </div>
            </div>
            <div class="col-12">
              <h6 class="text-center">Acto Resolutivo</h6>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fecha_ActoResolutivo_Inversion" value="{{ $inversion->fecha_ActoResolutivo_Inversion }}" class="input-auth"/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">URL <i class="fas fa-link"></i></label>
                  <input type="text" name="ActoResolutivo_URL" value="{{ $inversion->ActoResolutivo_URL }}" class="input-auth" placeholder="Ingrese Url"/>
                </div>
              </div>
            </div>
            <hr>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script> 
    //script para el select2
      $(document).ready(function() {
        $('#ModalEdit{{$inversion->idInversion}}').on('shown.bs.modal', function () {
          $('#idUsuarios{{$inversion->idInversion}}').select2({
            placeholder: "Selecciona un usuario",
            allowClear: true,
              language: {
                noResults: function() {
                  return "No se encontró el usuario";
                }
              },
              dropdownParent: $('#ModalEdit{{$inversion->idInversion}}')
          });
        });
        // Destruye Select2 cuando el modal se cierra para evitar problemas
        $('#ModalEdit{{$inversion->idInversion}}').on('hidden.bs.modal', function () {
          $('#idUsuarios{{$inversion->idInversion}}').select2('destroy');
        });
          // Validación del archivo (tamaño máximo 1MB)
        document.getElementById('archivoInversionedit{{ $inversion->idInversion }}').addEventListener('change', function () {
          const file = this.files[0];
          if (file && file.size > 1 * 1024 * 1024) {
            alert('El archivo es mayor a 1 MB. Por favor, selecciona un archivo más pequeño.');
            this.value = ''; // Limpia el input para que el usuario seleccione otro archivo
          }
        });
      });
    </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const inversionId = {{$inversion->idInversion}};
      const provinciaSelect = document.getElementById('provinciaInversionEdit' + inversionId);
      const distritoSelect = document.getElementById('distritoInversionEdit' + inversionId);

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
  </script>
</form>

<style>
  body {
    background-color: #000;
  }
  section {
    margin-top: 100px;
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