@extends('adminlte::page')

@section('title', 'Segmento')

@section('content_header')
  <h1><i class="fas fa-stream"></i> Segmentos</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Agregar -->
          <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Segmento</button>
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
            <table id="segmentosTable" class="table table-bordered table-striped">
              <thead class="table-header text-center">
                <tr>
                  <th class="text-left">#</th>
                  <th class="text-left">Nombre</th>
                  <th class="text-center">Usuario</th>
                  <th>Inversión</th>
                  <th class="text-nowrap">Fecha Inicio</th>
                  <th class="text-nowrap">Fecha Final</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($segmentos as $segmento)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td class="text-left">{{ $segmento->nombreSegmento }}</td>
                    <td class="text-nowrap text-center">{{ $segmento->usuario->nombreUsuario . ' ' . $segmento->usuario->apellidoUsuario }}</td>
                    <td>{{ $segmento->inversion->nombreInversion }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $segmento->fechaInicioSegmento }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $segmento->fechaFinalSegmento }}</td>
                    <td class="text-nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{$segmento->idSegmento}}"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEdit{{$segmento->idSegmento}}"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDelete{{$segmento->idSegmento}}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('segmento.create')
          </div>
        </div>
      </div>
      @foreach ($segmentos as $segmento)
        @include('segmento.delete', ['segmento' => $segmento])
        @include('segmento.edit', ['segmento' => $segmento])
        @include('segmento.show', ['segmento' => $segmento])
      @endforeach
    </div>
  </div>
@stop

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