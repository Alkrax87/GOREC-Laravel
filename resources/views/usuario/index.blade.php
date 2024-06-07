@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
  <h1><i class="fas fa-users"></i> Usuarios</h1>
  <hr>
@stop

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 px-0">
        <!-- Agregar -->
        <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Usuario</button>
        <!-- Alert -->
        @if ($message = Session::get('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
          </div>
        @endif
        <!-- Tabla -->
        <div class="table-responsive">
          <table id="segmentosTable" class="table table-bordered table-striped">
            <thead class="table-header">
              <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Profesión</th>
                <th>Especialidad</th>
                <th class="text-center">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario)
                <tr>
                  <td class="text-left">{{ $loop->index + 1 }}</td>
                  <td>{{ $usuario->nombreUsuario }}</td>
                  <td>{{ $usuario->apellidoUsuario }}</td>
                  <td>{{ $usuario->email }}</td>
                  <td>{{ $usuario->password }}</td>
                  <td>{{ $usuario->profesionUsuario}}</td>
                  <td>{{ $usuario->especialidadUsuario}}</td>
                  <td class="text-center" style="white-space: nowrap">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalShow{{$usuario->idUsuario}}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit{{$usuario->idUsuario}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$usuario->idUsuario}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @include('usuario.create')
        </div>
      </div>
    </div>
  </div>
  @foreach ($usuarios as $usuario)
    @include('usuario.delete', ['usuario' => $usuario])
    @include('usuario.edit', ['usuario' => $usuario])
    @include('usuario.show', ['usuario' => $usuario])
  @endforeach
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
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