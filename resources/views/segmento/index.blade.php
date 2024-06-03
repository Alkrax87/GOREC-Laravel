@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  <h1>SEGMENTOS</h1>
@stop

@section('content')
  <div class="container-fluid">
    <div class="row">
      <!-- Agregar -->
      <div class="col-12 py-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Segmento</button>
      </div>
      <!-- Tabla y alert -->
      <div class="col-12">

        <!-- Alert -->
        @if ($message = Session::get('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
          </div>
        @endif

        <!-- Tabla -->
        <div class="table-responsive">
          <table id="segmentosTable" class="table table-bordered table-striped">
            <thead class="text-center table-header">
              <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Inversión</th>
                <th>Usuario</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($segmentos as $segmento)
                <tr class="text-center">
                  <td class="text-left">{{ $segmento->idSegmento}}</td>
                  <td class="text-left">{{ $segmento->nombreSegmento}}</td>
                  <td>{{ $segmento->fechaInicioSegmento}}</td>
                  <td>{{ $segmento->fechaFinalSegmento}}</td>
                  <td>{{ $segmento->inversion->nombreInversion }}</td>
                  <td>{{ $segmento->usuario->nombreUsuario . ' ' . $segmento->usuario->apellidoUsuario }}</td>
                  <td>
                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#ModalShow{{$segmento->idSegmento}}">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#ModalEdit{{$segmento->idSegmento}}">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalDelete{{$segmento->idSegmento}}">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @include('segmento.create')
        </div>
      </div>
    </div>
  </div>
  @foreach ($segmentos as $segmento)
    @include('segmento.delete', ['segmento' => $segmento])

    @include('segmento.edit', ['segmento' => $segmento, 'inversiones' => $inversiones, 'usuarios' => $usuarios])
    @include('segmento.show', ['segmento' => $segmento])
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