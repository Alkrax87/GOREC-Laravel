@extends('adminlte::page')

@section('title', 'Complementario')

@section('content_header')
  <h1><i class="fas fa-window-restore"></i> Comentario Inversión</h1>
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
                  <th class="text-center">Asunto</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center text-nowrap">Fecha</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($comentarios as $comentario)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td>{{ $comentario->inversion->nombreCortoInversion }}</td>
                    <td>{{ $comentario->usuario->nombreUsuario . ' ' . $comentario->usuario->apellidoUsuario }}
                      <br>
                      P: (
                        @if ($comentario->usuario->profesiones->isNotEmpty())
                          @foreach ($comentario->usuario->profesiones as $profesion)
                            {{ $profesion->nombreProfesion }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )
                        &nbsp; | &nbsp;
                        E: (
                        @if ($comentario->usuario->especialidades->isNotEmpty())
                          @foreach ($comentario->usuario->especialidades as $especialidad)
                            {{ $especialidad->nombreEspecialidad }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )  
                    </td> 
                    <td class="text-left">{{ $comentario->asuntoComentarioInversion}}</td>
                    <td class="text-left">{{ $comentario->comentariosInversion}}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{  $comentario->fechaComentarioInversion ? \Carbon\Carbon::parse( $comentario->fechaComentarioInversion)->format('d/m/Y') : 'Por Definir' }}</td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-info"
                      href="{{ route('comentario.show', ['id' => $comentario->idComentarioInversion]) }}">
                      <i class="fas fa-eye"></i>
                      </a>
                      <a class="btn btn-warning"
                      href="{{route('comentario.edit', ['id' => $comentario->idComentarioInversion])}}">
                      <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('comentario.destroy', $comentario->idComentarioInversion) }}"
                        method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de borrar {{$comentario->asuntoComentarioInversion}}?')">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('comentario.create')
          </div>
        </div>
      </div>
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