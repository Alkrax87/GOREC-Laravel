@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
  <h1><i class="fas fa-user-shield"></i> Roles</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Alert -->
          @if ($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-check"></i>&nbsp;&nbsp; {{ $message }}</p>
            </div>
          @endif
          <!-- Tabla -->
          <div class="table-responsive">
            <table id="rolesTable" class="table table-bordered table-striped">
              <thead class="table-header">
                <tr>
                  <th>#</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Administrador</th>
                  <th class="text-center">Administrativo</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $usuario)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td>{{ $usuario->nombreUsuario }}</td>
                    <td>{{ $usuario->apellidoUsuario }}</td>
                    <td class="text-center">{{ str_replace('@gorec.com', '', $usuario->email) }}</td>
                    <td class="text-center" style="white-space: nowrap">
                      <label class="switch">
                        <input type="checkbox" data-toggle="modal" data-target="#ModalAdmin{{ $usuario->idUsuario }}" @checked($usuario->isAdmin)>
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td class="text-center" style="white-space: nowrap">
                      <label class="switch">
                        <input type="checkbox" data-toggle="modal" data-target="#ModalAdministrativo{{ $usuario->idUsuario }}" @checked($usuario->isAdministrativo)>
                        <span class="slider round"></span>
                      </label>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @foreach ($usuarios as $usuario)
    @include('roles.change', ['usuario' => $usuario])
    @include('roles.change2', ['usuario' => $usuario])
  @endforeach
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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      @foreach ($usuarios as $usuario)
        $('#ModalAdmin{{$usuario->idUsuario}}').on('hidden.bs.modal', function (e) {
          window.location.href = '{{ route('roles.index') }}';
        });
      @endforeach
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      @foreach ($usuarios as $usuario)
        $('#ModalAdministrativo{{$usuario->idUsuario}}').on('hidden.bs.modal', function (e) {
          window.location.href = '{{ route('roles.index') }}';
        });
      @endforeach
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#rolesTable').DataTable({
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