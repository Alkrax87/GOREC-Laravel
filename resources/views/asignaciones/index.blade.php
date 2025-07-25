@extends('adminlte::page')

@section('title', 'Asignaciones')

@section('content_header')
  <h1><i class="fas fa-user-tag"></i> Asignaciones</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Alert -->
          @if ($message = Session::get('profesional_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;  {!! session('profesional_message') !!}</p>
          </div>
          @endif
          @if ($error = Session::get('error'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p class="alert-message mb-0"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $error }}</p>
                </div>
          @endif
          @if ($error = Session::get('error_asistente'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $error }}</p>
            </div>
          @endif

          @if ($message = Session::get('asistente_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;  {!! session('asistente_message') !!}</p>
          </div>
          @endif

          @if ($message_observacion = Session::get('message_observacion'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;  {!! session('message_observacion') !!}</p>
          </div>
          @endif
          <!-- Tabla -->
          <div class="table-responsive">
            <table id="asignacionesTable" class="table table-bordered table-striped w-100">
              <thead class="table-header">
                <tr>
                  <th>#</th>
                  <th class="text-nowrap">CUI</th>
                  <th class="text-nowrap">Inversión</th>
                  <th class="text-center">Provincia</th>
                  <th class="text-center">Distrito</th>
                  <th class="text-center">Modalidad</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Opciones</th>
                  @if (Auth::user()->isAdmin)
                    <th class="text-center">Profesional</th>
                    <th class="text-center">Asistente</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($inversiones as $inversion)
                  <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-center text-nowrap">{{ $inversion->cuiInversion}}</td>
                    <td>{{ $inversion->nombreInversion}}</td>
                    <td class="text-center">{{ $inversion->provinciaInversion }}</td>
                    <td class="text-center">{{ $inversion->distritoInversion }}</td>
                    <td class="text-center">{{ $inversion->modalidadInversion }}</td>
                    <td class="text-center">{{ $inversion->estadoInversion }}</td>
                    <td class="text-center" style="white-space: nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{ $inversion->idInversion }}"><i class="fas fa-eye"></i></a>
                    </td>
                    @if (Auth::user()->isAdmin)
                      <td class="text-center" style="white-space: nowrap">
                        <a class="btn btn-success" data-toggle="modal" data-target="#ModalProfesional{{ $inversion->idInversion }}"><i class="fas fa-user-tie"></i> Profesionales</a>
                      </td>
                      <td class="text-center" style="white-space: nowrap">
                        <a class="btn btn-dark" data-toggle="modal" data-target="#ModalAsistentes{{ $inversion->idInversion }}"><i class="fas fa-users-cog"></i> Asistentes</a>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @foreach ($inversiones as $inversion)
        @include('asignaciones.profesional.index', [
          'inversion' => $inversion,
          'profesionales' => $profesionales->where('idInversion', $inversion->idInversion)
        ])
        @include('asignaciones.asistente.index', [
          'inversion' => $inversion,
          'asistentes' => $asistentes->where('idInversion', $inversion->idInversion),
          'profesionales' => $profesionales->where('idInversion', $inversion->idInversion)
        ])
        @include('asignaciones.show', [
          'inversion' => $inversion,
          'profesionales' => $profesionales->where('idInversion', $inversion->idInversion),
          'asistentes' => $asistentes->where('idInversion', $inversion->idInversion)
        ])
      @endforeach
    </div>
  </div>
@stop

@section('content_top_nav_right')
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-danger ml-3 navbar-badge"> {{ count($notificaciones) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; min-width: 600px;">
      <spa style="background-color: #9C0C27; color: azure;" class="dropdown-item dropdown-header text-center"><i class="fas fa-bell"></i> {{ count($notificaciones) }} Notificationes</spa>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#asignacionesTable').DataTable({
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