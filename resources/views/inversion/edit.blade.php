@extends('adminlte::page')

@section('title', 'Inversion • Editar')

@section('content_header')
  <h1><i class="fas fa-edit"></i> Editar Inversión: "{{ $inversion->nombreInversion }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('inversion.update', $inversion->idInversion) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
        <!-- Inputs -->
        @if (Auth::user()->isAdmin)
          <div class="mb-3">
            <label>CUI</label>
            <input type="text" name="cuiInversion" value="{{ $inversion->cuiInversion }}" class="form-control" placeholder="CUI" required/>
          </div>
          <div class="mb-3">
            <label>Nombre</label>
            <textarea name="nombreInversion" class="form-control" placeholder="Nombre Inversión" rows="4" required>{{ $inversion->nombreInversion }}</textarea>
          </div>
          <div class="mb-3">
            <label>Nombre Corto</label>
            <input type="text" name="nombreCortoInversion" value="{{ $inversion->nombreCortoInversion }}" class="form-control" placeholder="Nombre Corto" required/>
          </div>
          <div class="mb-3">
            <label>Responsable</label>
            <select name="idUsuario" class="form-select" required>
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
          <div class="mb-3">
            <label>Coordinadores</label>
            <button type="button" class="btn btn-success btn-sm" onclick="addMoreCoordinadores()">
              <i class="fas fa-plus"></i>
            </button>
            <div id="coordinadoresContainer">
              @if ($inversion->coordinadores->isEmpty())
                <div class="input-group mb-1">
                  <select name="idCoordinador[]" id="usuariosSelect" class="form-select" required>
                    <option value="" disabled selected>Selecciona un usuario</option>
                    @foreach ($usuarios as $usuario)
                      <option value="{{ $usuario->idUsuario }}">
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
                  <button type="button" class="btn btn-danger btn-sm disabled">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              @else
                @foreach ($inversion->coordinadores as $coordinador)
                  <div class="input-group mb-1">
                    <select name="idCoordinador[]" id="usuariosSelect" class="form-select" required>
                      <option value="" disabled selected>Selecciona un usuario</option>
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
                    <button type="button" class="btn btn-danger btn-sm {{ $loop->first ? 'disabled' : '' }}" onclick="removeCoordinador(this)" {{ $loop->first ? 'disabled' : '' }}>
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Provincia</label>
              <select name="provinciaInversion" id="provinciaInversion" class="form-select" required>
                <option value="" disabled>Selecciona una provincia</option>
                @foreach ($provincias as $provincia)
                  <option value="{{ $provincia['nombre'] }}" data-distritos="{{ json_encode($provincia['distritos']) }}" {{ $provincia['nombre'] == $inversion->provinciaInversion ? 'selected' : '' }}>
                    {{ $provincia['nombre'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label>Distrito</label>
              <select name="distritoInversion" id="distritoInversion" class="form-select" required>
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
          <div class="row mb-3">
            <div class="col-4">
              <label>Nivel</label>
              <select name="nivelInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona un nivel</option>
                <option value="EXPEDIENTE TÉCNICO" {{ $inversion->nivelInversion == 'EXPEDIENTE TÉCNICO' ? 'selected' : '' }}>EXPEDIENTE TÉCNICO</option>
                <option value="IOARR" {{ $inversion->nivelInversion == 'IOARR' ? 'selected' : '' }}>IOARR</option>
              </select>
            </div>
            <div class="col-8">
              <label>Función</label>
              <select name="funcionInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona una función</option>
                <option value="PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA" {{ $inversion->funcionInversion == 'PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA' ? 'selected' : '' }}>PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA</option>
                <option value="JUSTICIA" {{ $inversion->funcionInversion == 'JUSTICIA' ? 'selected' : '' }}>JUSTICIA</option>
                <option value="TRANSPORTE" {{ $inversion->funcionInversion == 'TRANSPORTE' ? 'selected' : '' }}>TRANSPORTE</option>
                <option value="SANEAMIENTO" {{ $inversion->funcionInversion == 'SANEAMIENTO' ? 'selected' : '' }}>SANEAMIENTO</option>
                <option value="SALUD" {{ $inversion->funcionInversion == 'SALUD' ? 'selected' : '' }}>SALUD</option>
                <option value="EDUCACIÓN" {{ $inversion->funcionInversion == 'EDUCACIÓN' ? 'selected' : '' }}>EDUCACIÓN</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label>Modalidad</label>
            <select name="modalidadInversion" class="form-select" required>
              <option value="" disabled selected>Selecciona una modalidad</option>
              <option value="DIRECTA" {{ $inversion->modalidadInversion == 'DIRECTA' ? 'selected' : '' }}>DIRECTA</option>
              <option value="CONTRATA" {{ $inversion->modalidadInversion == 'CONTRATA' ? 'selected' : '' }}>CONTRATA</option>
            </select>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Fecha Inicio</label>
              <input type="date" name="fechaInicioInversion" value="{{ $inversion->fechaInicioInversion }}" class="form-control" required/>
            </div>
            <div class="col-6">
              <label>Fecha Final</label>
              <input type="date" name="fechaFinalInversion" value="{{ $inversion->fechaFinalInversion }}" class="form-control" required/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Presupuesto Formulación</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary">S/</span>
                <input type="text" name="presupuestoFormulacionInversion" value="{{ $inversion->presupuestoFormulacionInversion }}" class="form-control" placeholder="Presupuesto Formulación" required>
              </div>
            </div>
            <div class="col-6">
              <label>Presupuesto Ejecución</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary">S/</span>
                <input type="text" name="presupuestoEjecucionInversion" value="{{ $inversion->presupuestoEjecucionInversion }}" class="form-control" placeholder="Presupuesto Ejecución" required>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Archivo</label>
            <input type="file" name="archivoInversion" id="archivoInversion" accept="application/pdf" class="form-control">
            @if ($inversion->archivoInversion)
              <p class="text-danger mb-2">Ya existe un archivo vinculado a esta Inversión.</p>
              <div class="d-flex align-items-center">
                <a href="{{ route('inversion.download', $inversion->idInversion) }}" class="btn btn-dark">
                  <i class="fas fa-file-download"></i>&nbsp;&nbsp; Descargar archivo actual
                </a>
                <div class="form-check ml-3">
                  <input type="checkbox" class="form-check-input" id="deleteFile" value="1" name="deleteFile">
                  <label class="form-check-label" for="deleteFile">Eliminar archivo actual</label>
                </div>
              </div>
            @endif
          </div>
        @endif
        <div class="mb-3">
          <label for="estadoInversion">Estado</label>
          <select name="estadoInversion" class="form-select" required>
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
        <h4 class="text-center">Conformidad Técnica</h4>
        <div class="d-flex align-items-center">
          <div class="col-6 mb-3">
            <label>Fecha</label>
            <input type="date" name="Fecha_ConformidadTecnica_Inversion" value="{{ $inversion->Fecha_ConformidadTecnica_Inversion }}" class="form-control"/>
          </div>
          <div class="col-6">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="ConformidadTecnica" value="SI" {{ $inversion->ConformidadTecnica === 'SI' ? 'checked' : '' }}>
              <label class="form-check-label" for="envioSi">Sí</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="ConformidadTecnica" value="NO" {{ $inversion->ConformidadTecnica === 'NO' ? 'checked' : '' }}>
              <label class="form-check-label" for="envioNo">No</label>
            </div>
          </div>
        </div>
        <h4 class="text-center">Aprobación de Consistencia</h4>
        <div class="row">
          <div class="col-6 mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fechaInicioConsistenciaInversion" value="{{ $inversion->fechaInicioConsistenciaInversion }}" class="form-control"/>
          </div>
          <div class="col-6 mb-3">
            <label>Fecha Final</label>
            <input type="date" name="fechaFinalConsistenciaInversion" value="{{ $inversion->fechaFinalConsistenciaInversion }}" class="form-control"/>
          </div>
        </div>
        <h4 class="text-center">Acto Resolutivo</h4>
        <div class="row mb-3">
          <div class="col-6">
            <label>Fecha</label>
            <input type="date" name="fecha_ActoResolutivo_Inversion" value="{{ $inversion->fecha_ActoResolutivo_Inversion }}" class="form-control"/>
          </div>
          <div class="col-6">
            <label>URL <i class="fas fa-link"></i></label>
            <input type="text" name="ActoResolutivo_URL" value="{{ $inversion->ActoResolutivo_URL }}" class="form-control" placeholder="Ingrese Url"/>
          </div>
        </div>
        <!-- Buttons -->
        <div class="pt-3 text-center">
          <a href="{{ route('inversion.index') }}" class="btn btn-primary mx-1"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</a>
          <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
        </div>
      </form>
    </div>
  </div>
@stop

@section('content_top_nav_right')
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-danger ml-3 navbar-badge"> {{ count($notificaciones) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; min-width: 600px;">
      <span class="gorec-notifications dropdown-header text-center"><i class="fas fa-bell"></i> {{ count($notificaciones) }} Notificationes</span>
      <div class="dropdown-divider"></div>
      @foreach ($notificaciones as $notificacion)
        <div class="dropdown-item">
          <span><i class="fas fa-clipboard-list"></i>&nbsp; <b>INVERSIÓN</b></span>
          <p>{{ $notificacion->nombreCortoInversion }} esta por finalizar.</p>
          <p class="pt-2 text-end"><i class="fas fa-calendar-alt"></i> Fecha de finalización: {{ $notificacion->fechaFinalInversion }}</p>
        </div>
      @endforeach
      <div class="dropdown-divider"></div>
    </div>
  </li>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('js')
  <script>
    // Coordinadores
    function addMoreCoordinadores() {
      const container = document.getElementById('coordinadoresContainer');
      const div = document.createElement('div');
      div.className = 'input-group mb-1';
      const usuariosSelect = document.getElementById('usuariosSelect');
      const newSelect = usuariosSelect.cloneNode(true);
      newSelect.id = '';
      Array.from(newSelect.options).forEach((opt, index) => {
        opt.removeAttribute('selected');
        if (index === 0) {
          opt.setAttribute('selected', 'selected');
        }
      });
      div.appendChild(newSelect);
      div.innerHTML += `
        <button type="button" class="btn btn-danger btn-sm" onclick="removeCoordinador(this)">
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
@stop