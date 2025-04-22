@extends('adminlte::page')

@section('title', 'Usuario • Editar')

@section('content_header')
  <h1><i class="fas fa-edit"></i> Editar Usuario: "{{ $usuario->nombreUsuario . " " . $usuario->apellidoUsuario }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('usuario.update', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
        <div class="mb-3">
          <label>Nombre(s)</label>
          <input type="text" name="nombreUsuario" value="{{ $usuario->nombreUsuario }}" class="form-control" placeholder="Ingrese Nombre(s)" required/>
        </div>
        <div class="mb-3">
          <label>Apellidos</label>
          <input type="text" name="apellidoUsuario" value="{{ $usuario->apellidoUsuario }}" class="form-control" placeholder="Ingrese Apellidos" required/>
        </div>
        <div class="mb-3">
          <label>Categoría</label>
          <select name="categoriaUsuario" class="form-select" required>
            <option value="" disabled selected>Selecciona una categoría</option>
            <option value="" disabled class="bold"><b>PROYECTISTA</b></option>
            <option value="DA-I" {{ $usuario->categoriaUsuario == 'DA-I' ? 'selected' : '' }}>DA-I</option>
            <option value="DA" {{ $usuario->categoriaUsuario == 'DA' ? 'selected' : '' }}>DA</option>
            <option value="PA" {{ $usuario->categoriaUsuario == 'PA' ? 'selected' : '' }}>PA</option>
            <option value="PB" {{ $usuario->categoriaUsuario == 'PB' ? 'selected' : '' }}>PB</option>
            <option value="PC" {{ $usuario->categoriaUsuario == 'PC' ? 'selected' : '' }}>PC</option>
            <option value="" disabled class="bold"><b>ASISTENTE</b></option>
            <option value="PD" {{ $usuario->categoriaUsuario == 'PD' ? 'selected' : '' }}>PD</option>
            <option value="PE" {{ $usuario->categoriaUsuario == 'PE' ? 'selected' : '' }}>PE</option>
            <option value="TA" {{ $usuario->categoriaUsuario == 'TA' ? 'selected' : '' }}>TA</option>
            <option value="TB" {{ $usuario->categoriaUsuario == 'TB' ? 'selected' : '' }}>TB</option>
            <option value="AA" {{ $usuario->categoriaUsuario == 'AA' ? 'selected' : '' }}>AA</option>
          </select>
        </div>
        <div class="col-13 mb-3">
          <label>Profesión</label>
          <button type="button" class="btn btn-success btn-sm" onclick="addProfesion()">
            <i class="fas fa-plus"></i>
          </button>
          <div id="profesionesContainer">
            @if ($usuario->profesiones->count() < 1)
              <div class="input-group mb-1">
                <select name="profesionUsuario[]" id="profesionesSelect" class="form-select" required>
                  <option value="" disabled selected>Selecciona una Profesión</option>
                  <option value="INGENIERÍA QUÍMICA">INGENIERÍA QUÍMICA</option>
                  <option value="INGENIERÍA SONIDO">INGENIERÍA SONIDO</option>
                  <option value="INGENIERÍA CIVIL">INGENIERÍA CIVIL</option>
                  <option value="INGENIERÍA MECATRÓNICA">INGENIERÍA MECATRÓNICA</option>
                  <option value="INGENIERÍA MECÁNICA">INGENIERÍA MECÁNICA</option>
                  <option value="INGENIERÍA SOFTWARE">INGENIERÍA SOFTWARE</option>
                  <option value="INGENIERÍA HARDWARE">INGENIERÍA HARDWARE</option>
                  <option value="INGENIERÍA INDUSTRIAL">INGENIERÍA INDUSTRIAL</option>
                  <option value="INGENIERÍA ELECTRÓNICA">INGENIERÍA ELECTRÓNICA</option>
                  <option value="INGENIERÍA SANITARIA">INGENIERÍA SANITARIA</option>
                  <option value="INGENIERÍA ELÉCTRICA">INGENIERÍA ELÉCTRICA</option>
                  <option value="INGENIERÍA AMBIENTAL">INGENIERÍA AMBIENTAL</option>
                  <option value="INGENIERÍA DE SISTEMAS">INGENIERÍA DE SISTEMAS</option>
                  <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
                  <option value="INGENIERÍA GEOLÓGICA">INGENIERÍA GEOLÓGICA</option>
                  <option value="INGENIERÍA DE MECÁNICA DE FLUIDOS">INGENIERÍA DE MECÁNICA DE FLUIDOS</option>
                  <option value="ANTROPOLOGÍA">ANTROPOLOGÍA</option>
                  <option value="BIOLOGÍA">BIOLOGÍA</option>
                  <option value="ARQUITECTURA">ARQUITECTURA</option>
                  <option value="ARQUEÓLOGO">ARQUEÓLOGO</option>
                  <option value="ABOGADO-DERECHO">ABOGADO-DERECHO</option>
                  <option value="ECONOMISTA-ECONOMÍA">ECONOMISTA-ECONOMÍA</option>
                  <option value="CONTALIBIDAD">CONTALIBIDAD</option>
                  <option value="AGRONOMÍA">AGRONOMÍA</option>
                  <option value="TURISMO Y HOTELERIA">TURISMO Y HOTELERIA</option>
                  <option value="ADMINISTRACIÓN">ADMINISTRACIÓN</option>
                  <option value="EDUCACIÓN">EDUCACIÓN</option>
                  <option value="ADMINISTRACIÓN DE EMPRESAS">ADMINISTRACIÓN DE EMPRESAS</option>
                  <option value="MARKETING">MARKETING</option>
                  <option value="CIENCIA DE LA COMUNICACIÓN">CIENCIA DE LA COMUNICACIÓN</option>
                  <option value="PSICOLOGIA">PSICOLOGIA</option>
                  <option value="QUIMICA Y BIOQUIMICA">QUIMICA Y BIOQUIMICA</option>
                  <option value="SECRETARIA">SECRETARIA</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm disabled">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            @else
              @foreach ($usuario->profesiones as $profesion)
                <div class="input-group mb-1">
                  <select name="profesionUsuario[]" id="profesionesSelect{{ $loop->index }}" class="form-select" required>
                    <option value="" disabled>Selecciona una Profesión</option>
                    <option value="INGENIERÍA QUÍMICA" {{ $profesion->nombreProfesion == 'INGENIERÍA QUÍMICA' ? 'selected' : '' }}>INGENIERÍA QUÍMICA</option>
                    <option value="INGENIERÍA SONIDO"  {{ $profesion->nombreProfesion == 'INGENIERÍA SONIDO' ? 'selected' : '' }}>INGENIERÍA SONIDO</option>
                    <option value="INGENIERÍA CIVIL" {{ $profesion->nombreProfesion == 'INGENIERÍA CIVIL' ? 'selected' : '' }}>INGENIERÍA CIVIL</option>
                    <option value="INGENIERÍA MECATRÓNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA MECATRÓNICA' ? 'selected' : '' }}>INGENIERÍA MECATRÓNICA</option>
                    <option value="INGENIERÍA MECÁNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA MECÁNICA' ? 'selected' : '' }}>INGENIERÍA MECÁNICA</option>
                    <option value="INGENIERÍA SOFTWARE" {{ $profesion->nombreProfesion == 'INGENIERÍA SOFTWARE' ? 'selected' : '' }}>INGENIERÍA SOFTWARE</option>
                    <option value="INGENIERÍA HARDWARE" {{ $profesion->nombreProfesion == 'INGENIERÍA HARDWARE' ? 'selected' : '' }}>INGENIERÍA HARDWARE</option>
                    <option value="INGENIERÍA INDUSTRIAL {{ $profesion->nombreProfesion == 'INGENIERÍA INDUSTRIAL' ? 'selected' : '' }}">INGENIERÍA INDUSTRIAL</option>
                    <option value="INGENIERÍA ELECTRÓNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELECTRÓNICA' ? 'selected' : '' }}>INGENIERÍA ELECTRÓNICA</option>
                    <option value="INGENIERÍA SANITARIA" {{ $profesion->nombreProfesion == 'INGENIERÍA SANITARIA' ? 'selected' : '' }}>INGENIERÍA SANITARIA</option>
                    <option value="INGENIERÍA ELÉCTRICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELÉCTRICA' ? 'selected' : '' }}>INGENIERÍA ELÉCTRICA</option>
                    <option value="INGENIERÍA AMBIENTAL" {{ $profesion->nombreProfesion == 'INGENIERÍA AMBIENTAL' ? 'selected' : '' }}>INGENIERÍA AMBIENTAL</option>
                    <option value="INGENIERÍA DE SISTEMAS" {{ $profesion->nombreProfesion == 'INGENIERÍA DE SISTEMAS' ? 'selected' : '' }}>INGENIERÍA DE SISTEMAS</option>
                    <option value="INGENIERÍA ELECTROMECÁNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELECTROMECÁNICA' ? 'selected' : '' }}>INGENIERÍA ELECTROMECÁNICA</option>
                    <option value="INGENIERÍA GEOLÓGICA" {{ $profesion->nombreProfesion == 'INGENIERÍA GEOLÓGICA' ? 'selected' : '' }}>INGENIERÍA GEOLÓGICA</option>
                    <option value="INGENIERÍA DE MECÁNICA DE FLUIDOS" {{ $profesion->nombreProfesion == 'INGENIERÍA DE MECÁNICA DE FLUIDOS' ? 'selected' : '' }}>INGENIERÍA DE MECÁNICA DE FLUIDOS</option>
                    <option value="ANTROPOLOGÍA" {{ $profesion->nombreProfesion == 'ANTROPOLOGÍA' ? 'selected' : '' }}>ANTROPOLOGÍA</option>
                    <option value="BIOLOGÍA" {{ $profesion->nombreProfesion == 'BIOLOGÍA' ? 'selected' : '' }}>BIOLOGÍA</option>
                    <option value="ARQUITECTURA" {{ $profesion->nombreProfesion == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                    <option value="ARQUEÓLOGO" {{ $profesion->nombreProfesion == 'ARQUEÓLOGO' ? 'selected' : '' }}>ARQUEÓLOGO</option>
                    <option value="ABOGADO-DERECHO" {{ $profesion->nombreProfesion == 'ABOGADO-DERECHO' ? 'selected' : '' }}>ABOGADO-DERECHO</option>
                    <option value="ECONOMISTA-ECONOMÍA" {{ $profesion->nombreProfesion == 'ECONOMISTA-ECONOMÍA' ? 'selected' : '' }}>ECONOMISTA-ECONOMÍA</option>
                    <option value="CONTALIBIDAD" {{ $profesion->nombreProfesion == 'CONTALIBIDAD' ? 'selected' : '' }}>CONTALIBIDAD</option>
                    <option value="AGRONOMÍA" {{ $profesion->nombreProfesion == 'AGRONOMÍA' ? 'selected' : '' }}>AGRONOMÍA</option>
                    <option value="TURISMO Y HOTELERIA" {{ $profesion->nombreProfesion == 'TURISMO Y HOTELERIA' ? 'selected' : '' }}>TURISMO Y HOTELERIA</option>
                    <option value="ADMINISTRACIÓN" {{ $profesion->nombreProfesion == 'ADMINISTRACIÓN' ? 'selected' : '' }}>ADMINISTRACIÓN</option>
                    <option value="EDUCACIÓN" {{ $profesion->nombreProfesion == 'EDUCACIÓN' ? 'selected' : '' }}>EDUCACIÓN</option>
                    <option value="ADMINISTRACIÓN DE EMPRESAS" {{ $profesion->nombreProfesion == 'ADMINISTRACIÓN DE EMPRESAS' ? 'selected' : '' }}>ADMINISTRACIÓN DE EMPRESAS</option>
                    <option value="MARKETING" {{ $profesion->nombreProfesion == 'MARKETING' ? 'selected' : '' }}>MARKETING</option>
                    <option value="CIENCIA DE LA COMUNICACIÓN" {{ $profesion->nombreProfesion == 'CIENCIA DE LA COMUNICACIÓN' ? 'selected' : '' }}>CIENCIA DE LA COMUNICACIÓN</option>
                    <option value="PSICOLOGIA" {{ $profesion->nombreProfesion == 'PSICOLOGIA' ? 'selected' : '' }}>PSICOLOGIA</option>
                    <option value="QUIMICA Y BIOQUIMICA" {{ $profesion->nombreProfesion == 'QUIMICA Y BIOQUIMICA' ? 'selected' : '' }}>QUIMICA Y BIOQUIMICA</option>
                    <option value="SECRETARIA" {{ $profesion->nombreProfesion == 'SECRETARIA' ? 'selected' : '' }}>SECRETARIA</option>
                  </select>
                  <button type="button" class="btn btn-danger btn-sm {{ $loop->first ? 'disabled' : '' }}" onclick="removeElement(this)" {{ $loop->first ? 'disabled' : '' }}>
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              @endforeach
            @endif
          </div>
        </div>
        <div class="mb-3">
          <label>Especialidad</label>
          <button type="button" class="btn btn-success btn-sm" onclick="addEspecialidad()">
            <i class="fas fa-plus"></i>
          </button>
          <div id="especialidadesContainer">
            @if ($usuario->especialidades->count() < 1)
              <div class="input-group mb-1">
                <input type="text" name="especialidadUsuario[]" class="form-control" placeholder="Ingrese una Especialidad" oninput="this.value = this.value.toUpperCase()" required/>
                <button type="button" class="btn btn-danger btn-sm disabled">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            @else
              @foreach ($usuario->especialidades as $especialidad)
                <div class="input-group mb-1"">
                  <input type="text" name="especialidadUsuario[]" value="{{ $especialidad->nombreEspecialidad }}" class="form-control" placeholder="Ingrese una Especialidad" required oninput="this.value = this.value.toUpperCase()"/>
                  <button type="button" class="btn btn-danger btn-sm {{ $loop->first ? 'disabled' : '' }}" onclick="removeElement(this)" {{ $loop->first ? 'disabled' : '' }}>
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              @endforeach
            @endif
          </div>
        </div>
        <div>
          <input type="hidden" class="form-control" name="observacionUsuario" value="{{ $usuario->ObservacionUser }}">
        </div>
        <div class="form-check pb-3">
          <input class="form-check-input" name="cuentaUsuario" type="checkbox" id="activarCrearCuenta" @if ($usuario->email) checked @endif>
          <label>Crear Cuenta</label>
        </div>
        <div class="card mb-3 {{ $usuario->email ? '' : 'd-none' }}" id="crearCuenta">
          <div class="card-header bg-success text-white">Crear Cuenta</div>
          <div class="card-body">
            <div class="mb-3">
              <label>Usuario</label>
              <input type="text" name="email" value="{{ str_replace('@gorec.com', '', $usuario->email) }}" class="form-control"/>
            </div>
            <div class="mb-1">
              <label>Contraseña</label>
              <input type="password" name="password" class="form-control"/>
            </div>
          </div>
        </div>
        <!-- Buttons -->
        <div class="pt-3 text-center">
          <a href="{{ url()->previous() }}" type="button" class="btn btn-primary mx-1"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</a>
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
    // Profesión
    function addProfesion() {
      const container = document.getElementById('profesionesContainer');
      const div = document.createElement('div');
      div.className = 'input-group mb-1';
      div.innerHTML += `
        <select name="profesionUsuario[]" id="profesionesSelect" class="form-select" required>
          <option value="" disabled selected>Selecciona una Profesión</option>
          <option value="INGENIERÍA QUÍMICA">INGENIERÍA QUÍMICA</option>
          <option value="INGENIERÍA SONIDO">INGENIERÍA SONIDO</option>
          <option value="INGENIERÍA CIVIL">INGENIERÍA CIVIL</option>
          <option value="INGENIERÍA MECATRÓNICA">INGENIERÍA MECATRÓNICA</option>
          <option value="INGENIERÍA MECÁNICA">INGENIERÍA MECÁNICA</option>
          <option value="INGENIERÍA SOFTWARE">INGENIERÍA SOFTWARE</option>
          <option value="INGENIERÍA HARDWARE">INGENIERÍA HARDWARE</option>
          <option value="INGENIERÍA INDUSTRIAL">INGENIERÍA INDUSTRIAL</option>
          <option value="INGENIERÍA ELECTRÓNICA">INGENIERÍA ELECTRÓNICA</option>
          <option value="INGENIERÍA SANITARIA">INGENIERÍA SANITARIA</option>
          <option value="INGENIERÍA ELÉCTRICA">INGENIERÍA ELÉCTRICA</option>
          <option value="INGENIERÍA AMBIENTAL">INGENIERÍA AMBIENTAL</option>
          <option value="INGENIERÍA DE SISTEMAS">INGENIERÍA DE SISTEMAS</option>
          <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
          <option value="INGENIERÍA GEOLÓGICA">INGENIERÍA GEOLÓGICA</option>
          <option value="INGENIERÍA DE MECÁNICA DE FLUIDOS">INGENIERÍA DE MECÁNICA DE FLUIDOS</option>
          <option value="ANTROPOLOGÍA">ANTROPOLOGÍA</option>
          <option value="BIOLOGÍA">BIOLOGÍA</option>
          <option value="ARQUITECTURA">ARQUITECTURA</option>
          <option value="ARQUEÓLOGO">ARQUEÓLOGO</option>
          <option value="ABOGADO-DERECHO">ABOGADO-DERECHO</option>
          <option value="ECONOMISTA-ECONOMÍA">ECONOMISTA-ECONOMÍA</option>
          <option value="CONTALIBIDAD">CONTALIBIDAD</option>
          <option value="AGRONOMÍA">AGRONOMÍA</option>
          <option value="TURISMO Y HOTELERIA">TURISMO Y HOTELERIA</option>
          <option value="ADMINISTRACIÓN">ADMINISTRACIÓN</option>
          <option value="EDUCACIÓN">EDUCACIÓN</option>
          <option value="ADMINISTRACIÓN DE EMPRESAS">ADMINISTRACIÓN DE EMPRESAS</option>
          <option value="MARKETING">MARKETING</option>
          <option value="CIENCIA DE LA COMUNICACIÓN">CIENCIA DE LA COMUNICACIÓN</option>
          <option value="PSICOLOGIA">PSICOLOGIA</option>
          <option value="QUIMICA Y BIOQUIMICA">QUIMICA Y BIOQUIMICA</option>
          <option value="SECRETARIA">SECRETARIA</option>
        </select>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">
          <i class="fas fa-trash-alt"></i>
        </button>
      `;
      container.appendChild(div);
    }

    // Especialidad
    function addEspecialidad() {
      const container = document.getElementById('especialidadesContainer');
      const div = document.createElement('div');
      div.className = 'input-group mb-1';
      div.innerHTML += `
        <input type="text" name="especialidadUsuario[]" class="form-control" placeholder="Ingrese Especialidad" oninput="this.value = this.value.toUpperCase()" required/>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">
          <i class="fas fa-trash-alt"></i>
        </button>
      `;
      container.appendChild(div);
    }

    function removeElement(element) {
      element.parentNode.remove();
    }

    // Activar crear cuenta
    const activarCrearCuenta = document.getElementById('activarCrearCuenta');
    const crearCuenta = document.getElementById('crearCuenta');
    activarCrearCuenta.addEventListener('change', function() {
      if (this.checked) {
        crearCuenta.classList.remove('d-none');
      } else {
        activarCrearCuenta.removeAttribute("checked");
        crearCuenta.classList.add('d-none');
      }
    });
  </script>
@stop