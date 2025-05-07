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
          <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Estudios</button>
        </div>
        <!-- Tabla y alert -->
        <div class="col-12">
          <!-- Alert -->
          @if ($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
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
                  <th class="text-center">Inversión</th>
                  <th class="text-center">Proyectista</th>
                  <th class="text-center">Nombre Complementario</th>
                  <th class="text-center">Observacion</th>
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
                    <td>{{ $complementario->usuario->nombreUsuario . ' ' . $complementario->usuario->apellidoUsuario }}
                      <br>
                      P: (
                        @if ($complementario->usuario->profesiones->isNotEmpty())
                          @foreach ($complementario->usuario->profesiones as $profesion)
                            {{ $profesion->nombreProfesion }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )
                        &nbsp; | &nbsp;
                        E: (
                        @if ($complementario->usuario->especialidades->isNotEmpty())
                          @foreach ($complementario->usuario->especialidades as $especialidad)
                            {{ $especialidad->nombreEspecialidad }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )  
                    </td> 
                    <td class="text-left">{{ $complementario->nombreEstudiosComplementarios}}</td>
                    <td class="text-left">{{ $complementario->observacionEstudiosComplementarios}}</td>
                    <td class="text-center">{{ $complementario->estadoEstudiosComplementarios}}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{  $complementario->fechaInicioEstudiosComplementarios ? \Carbon\Carbon::parse( $complementario->fechaInicioEstudiosComplementarios)->format('d/m/Y') : 'Por Definir' }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{  $complementario->fechaFinalEstudiosComplementarios ? \Carbon\Carbon::parse( $complementario->fechaFinalEstudiosComplementarios)->format('d/m/Y') : 'Por Definir' }} </td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEdit{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDelete{{$complementario->idEstudiosComplementarios}}"><i class="fas fa-trash-alt"></i></a>
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
      $('#segmentosTable').DataTable({
        responsive: true,
        pageLength: 25,
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando página _PAGE_ de _PAGES_",
          infoEmpty: "No hay registros disponibles",
          infoFiltered: "(filtrado de _MAX_ registros totales)",
          emptyTable: "No hay datos disponibles en la tabla",
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