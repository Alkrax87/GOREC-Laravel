@extends('adminlte::page')

@section('title', 'Especialidad')

@section('content_header')
  <h1><i class="fas fa-users-cog"></i> Especialidad</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div class="row">
            @php
              $usuario = Auth::user();
              $esCoordinador = false;
              $esResponsable = false;
              $esProfesional = false;
              $esAdmin = $usuario->isAdmin;

              foreach ($inversiones as $inv) {
                  if ($inv->coordinadores->contains('idUsuario', $usuario->idUsuario)) {
                      $esCoordinador = true;
                  }
                  if ($inv->idUsuario == $usuario->idUsuario) {
                      $esResponsable = true;
                  }
                  if ($inv->profesional->contains('idUsuario', $usuario->idUsuario)) {
                      $esProfesional = true;
                  }
              }
            @endphp
            @if ($esAdmin || $esResponsable)
            <!-- Agregar -->
            <div class="col-9 d-flex align-items-end">
              <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate">
                <i class="fas fa-plus"></i>&nbsp;&nbsp; Crear Especialidad
              </button>
            </div>
           @endif
             @if ($esAdmin || $esResponsable ||  $esCoordinador)
            <!-- Imprimir -->
            <div class="col-3 mb-4">
              <form action="{{ route('especialidad.pdf') }}" method="GET" target="_blank">
                <label class="form-label" style="text-align: left; display: block;">Inversión:</label>
                <div class="mb-3">
                  <select name="idInversion" id="idInversion-especialidad" class="form-select form-select-sm input-auth"
                  required>
                  <option value="" disabled selected>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}">
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                  </select>
                </div>
                <div>
                  <button type="submit" class="btn btn-dark w-100"><i class="fas fa-print"></i>&nbsp;&nbsp;
                    Imprimir</button>
                </div>
              </form>
            </div>
             @endif
          </div>
          <!-- Alert -->
          @if ($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {!! session('message') !!}</p>
            </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible pb-0">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h6><i class="icon fas fa-ban"></i> Error! Por favor corrige los errores en el formulario.</h6>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if ($errorPorcentaje = Session::get('errorPorcentaje'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0">
                <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $errorPorcentaje }}
              </p>
            </div>
          @endif
          @if ($errorusuario = Session::get('errorusuario'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0">
                <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $errorusuario }}
              </p>
            </div>
          @endif
          <!-- Tabla -->
          <div class="table-responsive">
            <table id="especialidadTable" class="table table-bordered table-striped">
              <thead class="table-header">
                <tr>
                  <th class="text-left">#</th>
                  <th class="text-left">Inversión</th>
                  <th class="text-center">Nombre Especialidad</th>
                  <th class="text-center">Proyectistas</th>
                  <th class="text-center text-nowrap">Avance Programado</th>
                  <th class="text-center text-nowrap">Avance %</th>
                  <th class="text-center">Actividad</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($especialidades as $especialidad)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td>{{ $especialidad->inversion->nombreCortoInversion }}</td>
                    <td class="text-center text-nowrap">{{ $especialidad->nombreEspecialidad }}</td>
                    <td class="text-nowrap text-center">
                      @foreach ($especialidad->usuarios as $usuario)
                        <i class="fas fa-caret-right"></i>
                        {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}<br>
                      @endforeach
                    </td>
                    <td class="project_progress text-nowrap">
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                          aria-valuenow="{{ $especialidad->porcentajeAvanceEspecialidad }}" aria-valuemin="0"
                          aria-valuemax="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                          style="width: {{ $especialidad->porcentajeAvanceEspecialidad }}%">
                        </div>
                      </div>
                      <div class="w-100 text-center">
                        <small>{{ $especialidad->porcentajeAvanceEspecialidad }}% Especialidad</small>
                      </div>
                    </td>
                    <td class="project_progress text-nowrap">
                      <div class="progress">
                        <div
                          class="progress-bar progress-bar-striped
                          @if ($especialidad->avanceTotalEspecialidad < $especialidad->porcentajeAvanceEspecialidad * 0.25) bg-danger
                          @elseif(
                              $especialidad->avanceTotalEspecialidad >= $especialidad->porcentajeAvanceEspecialidad * 0.25 &&
                                  $especialidad->avanceTotalEspecialidad < $especialidad->porcentajeAvanceEspecialidad * 0.75)
                              bg-warning
                          @elseif(
                              $especialidad->avanceTotalEspecialidad >= $especialidad->porcentajeAvanceEspecialidad * 0.75 &&
                                  $especialidad->avanceTotalEspecialidad < $especialidad->porcentajeAvanceEspecialidad)
                              bg-success
                          @else
                              bg-info @endif"
                          role="progressbar" aria-valuenow="{{ $especialidad->avanceTotalEspecialidad }}"
                          aria-valuemin="0" aria-valuemax="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                          style="width: {{ $especialidad->avanceTotalEspecialidad }}%">
                        </div>
                      </div>
                      <div class="w-100 text-center">
                        <small>{{ $especialidad->avanceTotalEspecialidad }}% Completado</small>
                      </div>
                    </td>
                    <td class="text-center text-nowrap">
                      <a class="btn bg-olive color-palette"
                        href="{{ route('especialidad.actividades', ['id' => $especialidad->idEspecialidad]) }}">
                        <i class="fas fa-briefcase"></i> Actividades
                      </a>
                    </td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-info"
                        href="{{ route('especialidad.show', ['id' => $especialidad->idEspecialidad]) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      @if (Auth::user()->isAdmin || Auth::user()->idUsuario == $especialidad->inversion->idUsuario)
                        <a class="btn btn-secondary"
                          href="{{ route('especialidad.avance', ['id' => $especialidad->idEspecialidad]) }}">
                          <i class="fas fa-chart-line"></i>
                        </a>
                        <a class="btn btn-warning"
                          href="{{route('especialidad.edit', ['id' => $especialidad->idEspecialidad])}}">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('especialidad.destroy', $especialidad->idEspecialidad) }}"
                          method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de borrar {{$especialidad->nombreEspecialidad}}?')">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('especialidad.create')
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('content_top_nav_right')
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-danger ml-3 navbar-badge">
        {{ count($notificaciones) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
      style="left: inherit; right: 0px; min-width: 600px;">
      <spa style="background-color: #9C0C27; color: azure;" class="dropdown-item dropdown-header text-center"><i
          class="fas fa-bell"></i> {{ count($notificaciones) }} Notificationes</spa>
      <div class="dropdown-divider"></div>
      @foreach ($notificaciones as $notificacion)
        <div class="dropdown-item">
          <span><i class="fas fa-clipboard-list"></i>&nbsp; <b>INVERSIÓN</b></span>
          <p>{{ $notificacion->nombreCortoInversion }} esta por finalizar.</p>
          <p class="pt-2 text-end"><i class="fas fa-calendar-alt"></i> Fecha de finalización:
            {{ $notificacion->fechaFinalInversion }}</p>
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
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#idInversion-especialidad').select2({
        placeholder: "Selecciona una inversion",
        allowClear: true,
        width: '100%',
        language: {
          noResults: function() {
            return "No se encontró la inversión";
          }
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#especialidadTable').DataTable({
        responsive: true,
        pageLength: 25,
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando página _PAGE_ de _PAGES_",
          infoEmpty: "No hay registros disponibles",
          infoFiltered: "(filtrado de _MAX_ registros totales)",
          paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
          }
        }
      });
    });
  </script>
@stop
