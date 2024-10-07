@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
  <h1><i class="fas fa-users"></i> Usuarios</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Agregar -->
          @if (Auth::user()->isAdmin)
            <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Usuario</button>
          @endif
          <!-- Alert -->
          @if ($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-check"></i>&nbsp;&nbsp; {{ $message }}</p>
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
          <!-- Tabla -->
          <div class="table-responsive">
            <table id="segmentosTable" class="table table-bordered table-striped text-center">
              <thead class="table-header">
                <tr>
                  <th>#</th>
                  <th class="text-left">Nombres</th>
                  <th class="text-left">Apellidos</th>
                  <th>Usuario</th>
                  <th>Rol</th>
                  <th>Categoría</th>
                  <th>Profesión</th>
                  <th>Especialidad</th>
                  <th>Responsable en</th>
                  <th>Profesional en</th>
                  <th>Asistente en</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $usuario)
                  <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-left">{{ $usuario->nombreUsuario }}</td>
                    <td class="text-left">{{ $usuario->apellidoUsuario }}</td>
                    <td>{{ str_replace('@gorec.com', '', $usuario->email) }}</td>
                    @if ($usuario->isAdmin)
                      <td class="project-state">
                        <span class="badge badge-danger">Administrador</span>
                      </td>
                    @elseif ((str_replace('@gorec.com', '', $usuario->email)) != '')
                      <td class="project-state">
                        <span class="badge badge-success">Profesional</span>
                      </td>
                    @else
                      <td class="project-state">
                        <span class="badge badge-warning">Asistente</span>
                      </td>
                    @endif
                    <td>{{ $usuario->categoriaUsuario }}</td>
                    <td>
                      @foreach ($usuario->profesiones as $profesion)
                        <i class="fas fa-caret-right"></i> {{ $profesion->nombreProfesion }}<br>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($usuario->especialidades as $especialidad)
                        <i class="fas fa-caret-right"></i> {{ $especialidad->nombreEspecialidad }}<br>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($usuario->inversion as $inversion)
                        <i class="fas fa-caret-right"></i> {{ $inversion->nombreCortoInversion }}<br>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($usuario->asignacionesProfesional as $asignacion)
                        <i class="fas fa-caret-right"></i> {{ $asignacion->inversion->nombreCortoInversion }}<br>
                      @endforeach
                    </td> <!-- Columna de profesional -->
                    <td>
                      @foreach ($usuario->asignacionesAsistente as $asignacion)
                        <i class="fas fa-caret-right"></i> {{ $asignacion->inversion->nombreCortoInversion }}<br>
                      @endforeach
                    </td> <!-- Columna de asistente -->
                    <td class="text-center" style="white-space: nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{$usuario->idUsuario}}"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEdit{{$usuario->idUsuario}}"><i class="fas fa-edit"></i></a>
                      @if (!$loop->first)
                        <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDelete{{$usuario->idUsuario}}"><i class="fas fa-trash-alt"></i></a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('usuario.create')
          </div>
        </div>
      </div>
      @foreach ($usuarios as $usuario)
        @include('usuario.delete', ['usuario' => $usuario])
        @include('usuario.edit', ['usuario' => $usuario])
        @include('usuario.show', ['usuario' => $usuario])
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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
    a {
      text-decoration: none;
    }
    .btn-option{
      height: 38px;
    }
    .btn-option i{
      padding-top: 4px;
    }
  </style>
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#segmentosTable').DataTable({
        responsive: true,
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