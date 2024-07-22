@extends('adminlte::page')

@section('title', 'Complementario')

@section('content_header')
  <h1><i class="fas fa-window-restore"></i> Complementarios</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <!-- Agregar -->
        <div class="col-12">
          @if (Auth::user()->isAdmin)
            <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Estudios</button>
          @endif
        </div>
        <!-- Tabla y alert -->
        <div class="col-12">
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
              <thead class="table-header">
                <tr>
                  <th class="text-left">#</th>
                  <th class="text-left">Inversión</th>
                  <th class="text-left">Nombre</th>
                  <th class="text-left">Observacion</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center text-nowrap">Fecha Inicio</th>
                  <th class="text-center text-nowrap">Fecha Final</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($complementarios as $complementario)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td>{{ $complementario->inversion->nombreCortoInversion }}</td>
                    <td class="text-left">{{ $complementario->nombreEstudiosComplementarios}}</td>
                    <td class="text-left">{{ $complementario->observacionEstudiosComplementarios}}</td>
                    <td class="text-center">{{ $complementario->estadoEstudiosComplementarios}}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $complementario->fechaInicioEstudiosComplementarios }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $complementario->fechaFinalEstudiosComplementarios}}</td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-eye"></i></a>
                      @if (Auth::user()->isAdmin)
                        <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEdit{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDelete{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-trash-alt"></i></a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('complementario.create')
          </div>
        </div>
      </div>
      @foreach ($complementarios as $complementario)
        @include('complementario.delete', ['complementario' => $complementario])
        @include('complementario.edit', ['complementario' => $complementario])
        @include('complementario.show', ['complementario' => $complementario])
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