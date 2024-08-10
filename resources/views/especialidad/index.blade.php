@extends('adminlte::page')

@section('title', 'Especiaidad')

@section('content_header')
  <h1><i class="fas fa-users-cog"></i> Especialidad</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Agregar -->
          <div class="row">
            <div class="col-6">
              <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Crear Especialidad</button>
            </div>
            <div class="col-6 text-end">
              <a href="{{route('especialidad.pdf')}}" class="btn btn-dark" target="_blank"><i class="fas fa-print"></i>&nbsp;&nbsp; Imprimir</a>
            </div>
          </div>
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
          @if ($errorPorcentaje = Session::get('errorPorcentaje'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $errorPorcentaje }}</p>
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
                  <th class="text-center">Responsables</th>
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
                        <i class="fas fa-caret-right"></i> {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}<br>
                      @endforeach
                    </td>
                    <td class="project_progress text-nowrap">
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                          aria-valuenow="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                          aria-valuemin="0"
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
                        <div class="progress-bar progress-bar-striped
                          @if($especialidad->avanceTotalEspecialidad < ($especialidad->porcentajeAvanceEspecialidad*0.25))
                              bg-danger
                          @elseif($especialidad->avanceTotalEspecialidad >= ($especialidad->porcentajeAvanceEspecialidad*0.25) && $especialidad->avanceTotalEspecialidad < ($especialidad->porcentajeAvanceEspecialidad*0.75))
                              bg-warning
                          @elseif($especialidad->avanceTotalEspecialidad >= ($especialidad->porcentajeAvanceEspecialidad*0.75) && $especialidad->avanceTotalEspecialidad < $especialidad->porcentajeAvanceEspecialidad)
                              bg-success
                          @else
                              bg-info
                          @endif"
                          role="progressbar"
                          aria-valuenow="{{ $especialidad->avanceTotalEspecialidad }}"
                          aria-valuemin="0"
                          aria-valuemax="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                          style="width: {{$especialidad->avanceTotalEspecialidad }}%">
                        </div>
                      </div>
                      <div class="w-100 text-center">
                        <small>{{ $especialidad->avanceTotalEspecialidad }}% Completado</small>
                      </div>
                    </td>
                    <td class="text-center text-nowrap">
                      <a class="btn bg-olive color-palette" data-toggle="modal" data-target="#ModalFase{{ $especialidad->idEspecialidad }}"><i class="fas fa-briefcase"></i> Actividades</a>
                    </td>
                    <td class="text-center" style="white-space: nowrap"">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{ $especialidad->idEspecialidad }}"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEditEspecialidad{{ $especialidad->idEspecialidad }}"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDeleteEspecialidad{{ $especialidad->idEspecialidad }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('especialidad.create')
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
      $('#especialidadTable').DataTable({
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