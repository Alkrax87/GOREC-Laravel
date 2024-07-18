@extends('adminlte::page')

@section('title', 'Complementario')

@section('content_header')
  <h1>Especialidad</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
       <div class="row">
      <!-- Agregar -->
        <div class="col-12 py-2">
            <button class="btn btn-success" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Crear Especialidad</button>
        </div>
        <!-- Tabla y alert -->
        <div class="col-12">
        <!-- Alert -->
        @if ($message = Session::get('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
          </div>
        @endif
        <div class="row mt-3">
          <div class="col-12 py-2 text-end">
             <a href="{{route('especialidad.pdf')}}" class="btn btn-success" target="_blank"><img width="25" height="25" src="https://img.icons8.com/3d-fluency/94/print.png" alt="print"/>PDF</a>
          </div>
      </div>
        <!-- Tabla -->
        <div class="table-responsive">
          <table id="segmentosTable" class="table table-bordered table-striped">
            <thead class="table-header">
              <tr>
                <th class="text-left">#</th>
                <th class="text-center">Inversión</th>
                <th class="text-center">Jefe</th>
                <th class="text-left">Nombre Especialidad</th>
                <th class="text-left">Porcentaje de Especialidad</th>
                <th class="text-left">Porcentaje Avance</th>
                <th class="text-center">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($especialidades as $especialidad)
                <tr>
                  <td class="text-left">{{ $loop->index + 1 }}</td>
                  <td>{{ $especialidad->inversion->nombreInversion }}</td>
                  <td>
                  @foreach ($especialidad->usuarios as $usuario)
                  <i class="fas fa-caret-right"></i> {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}<br>
                @endforeach
                  </td> 
                  <td class="text-left">{{ $especialidad->nombreEspecialidad}}</td>
                  <td class="text-left">{{ $especialidad->porcentajeAvanceEspecialidad}}</td>
                  <td class="text-left">{{ $especialidad->avanceTotalEspecialidad}}</td>
                  <td class="text-center" style="white-space: nowrap"">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalShow{{$especialidad->idEspecialidad}}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEditEspecialidad{{$especialidad->idEspecialidad}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteEspecialidad{{$especialidad->idEspecialidad}}"><i class="fas fa-trash-alt"></i></a>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#ModalFase{{$especialidad->idEspecialidad}}"><i class="fas fa-stream"></i></a>
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
@foreach ($especialidades as $especialidad)
    @include('especialidad.fase.index', [
      'especialidad' => $especialidad,
      'fases' => $fases->where('idEspecialidad', $especialidad->idEspecialidad),
    ])
     @include('especialidad.show', [
      'especialidad' => $especialidad,
      'fases' => $fases->where('idEspecialidad', $especialidad->idEspecialidad),
    ])
     @include('especialidad.delete', ['especialidad' => $especialidad])
     @include('especialidad.edit', ['especialidad' => $especialidad])
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