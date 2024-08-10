@extends('adminlte::page')

@section('title', 'Inversion')

@section('content_header')
  <h1><i class="fas fa-clipboard-list"></i> Inversiones</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Agregar -->
          <div class="row">
            @if (Auth::user()->isAdmin)
              <div class="col-6">
                <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Inversión</button>
              </div>
              <div class="col-6 text-end">
                <a href="{{route('inversion.pdfs')}}" class="btn btn-dark" target="_blank"><i class="fas fa-print"></i>&nbsp;&nbsp; Imprimir</a>
              </div>
            @endif
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
          <!-- Tabla -->
          <div class="table-responsive">
            <table id="segmentosTable" class="table table-bordered table-striped">
              <thead class="table-header">
                <tr>
                  <th>#</th>
                  <th class="text-nowrap">CUI</th>
                  <th class="text-nowrap" style="min-width: 400px">Nombre</th>
                  <th class="text-nowrap">Nombre Corto</th>
                  <th class="text-center">Responsable</th>
                  <th class="text-center">Avance</th>
                  <th class="text-center">Provincia</th>
                  <th class="text-center">Distrito</th>
                  <th class="text-center">Estado</th>
                  <th class="text-nowrap">Fecha Inicio</th>
                  <th class="text-nowrap">Fecha Final</th>
                  <th class="text-center">Nivel</th>
                  <th class="text-center">Función</th>
                  <th class="text-center">Modalidad</th>
                  <th class="text-nowrap">Presupuesto Formulación</th>
                  <th class="text-nowrap">Presupuesto Ejecución</th>
                  <th class="text-nowrap">Fecha Inicio Consistencia</th>
                  <th class="text-nowrap">Fecha Final Consistencia</th>
                  <th class="text-center">Extras</th>
                  <th class="text-center">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($inversiones as $inversion)
                  <tr>
                    <td class="text-left">{{ $loop->index + 1 }}</td>
                    <td class="text-nowrap">{{ $inversion->cuiInversion }}</td>
                    <td>{{ $inversion->nombreInversion }}</td>
                    <td>{{ $inversion->nombreCortoInversion }}</td>
                    <td class="text-nowrap text-center">{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</td>
                    <td class="project_progress text-nowrap">
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped
                          @if($inversion->avanceInversion < 25)
                              bg-danger
                          @elseif($inversion->avanceInversion >= 25 && $inversion->avanceInversion < 75)
                              bg-warning
                          @elseif($inversion->avanceInversion >= 75 && $inversion->avanceInversion < 100)
                              bg-success
                          @else
                              bg-info
                          @endif"
                          role="progressbar"
                          aria-valuenow="{{ $inversion->avanceInversion }}"
                          aria-valuemin="0"
                          aria-valuemax="100"
                          style="width: {{ $inversion->avanceInversion }}%">
                      </div>
                        </div>
                      </div>
                      <small>{{ $inversion->avanceInversion }}% Completado</small>
                    </td>
                    <td class="text-center">{{ $inversion->provinciaInversion }}</td>
                    <td class="text-center">{{ $inversion->distritoInversion }}</td>
                    <td class="text-center">{{ $inversion->estadoInversion }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $inversion->fechaInicioInversion }}</td>
                    <td class="text-center"><i class="fas fa-calendar-alt"></i>&nbsp; {{ $inversion->fechaFinalInversion }}</td>
                    <td class="text-center">{{ $inversion->nivelInversion }}</td>
                    <td class="text-center">{{ $inversion->funcionInversion }}</td>
                    <td class="text-center">{{ $inversion->modalidadInversion }}</td>
                    <td class="text-center">{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</td>
                    <td class="text-center">{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</td>
                    <td class="text-center">
                      <i class="fas fa-calendar-alt"></i>&nbsp;
                      @if(is_null($inversion->fechaInicioConsistenciaInversion))
                        Por Definir
                      @else
                        {{ $inversion->fechaInicioConsistenciaInversion }}
                      @endif
                    </td>
                    <td class="text-center">
                      <i class="fas fa-calendar-alt"></i>&nbsp;
                      @if(is_null($inversion->fechaFinalConsistenciaInversion))
                        Por Definir
                      @else
                        {{ $inversion->fechaFinalConsistenciaInversion }}
                      @endif
                    </td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-dark btn-option" href="{{route('inversion.pdf', $inversion->idInversion)}}" target="_blank"><i class="fas fa-print"></i></a>
                      @if (Auth::user()->isAdmin)
                        <a class="btn btn-secondary btn-option" data-toggle="modal" data-target="#ModalLog{{$inversion->idInversion}}"><i class="fas fa-list"></i></a>
                      @endif
                    </td>
                    <td class="text-center text-nowrap">
                      <a class="btn btn-info btn-option" data-toggle="modal" data-target="#ModalShow{{$inversion->idInversion}}"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-warning btn-option" data-toggle="modal" data-target="#ModalEdit{{$inversion->idInversion}}"><i class="fas fa-edit"></i></a>
                      @if (Auth::user()->isAdmin)
                        <a class="btn btn-danger btn-option" data-toggle="modal" data-target="#ModalDelete{{$inversion->idInversion}}"><i class="fas fa-trash-alt"></i></a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('inversion.create')
          </div>
        </div>
      </div>
      @foreach ($inversiones as $inversion)
        @include('inversion.delete', ['inversion' => $inversion])
        @include('inversion.edit', ['inversion' => $inversion])
        @include('inversion.show', ['inversion' => $inversion])
        @include('inversion.estadoLog', [
          'inversion' => $inversion,
          'logs' => $logs->where('idInversion', $inversion->idInversion),
        ])
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
  <style>
    body {
      background-color: #000;
    }
    section {
      margin-top: 100px;
    }
    /* Others */
    .center-items {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* Card Style */
    .cascading-left {
      margin-left: -50px;
    }
    /* Input Style  */
    .input-auth {
      display: block;
      width: 100%;
      height: calc(1.5em + 0.75rem + 2px);
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: all 0.3s ease-in-out;
    }
    .input-auth:focus {
      border-color: #72081f;
      outline: none;
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .input-autht:focus::placeholder {
      color: transparent;
    }
    /* Btn Style  */
    .btn-gorec {
      width: 250px;
      height: 50px;
      background-color: #9C0C27;
      color: #fff;
      border-radius: 50px
    }
    .btn-gorec:hover {
      background-color: #72081f;
      color: #fff;;
    }
    /* Line */
    .line {
      border: 0;
      border-top: 1px solid #72081f;
      margin: 1rem 0;
      width: 50%;
    }
    /* Redirection */
    .login-direction {
      color: #72081f;
      text-decoration: none;
    }
    @media (max-width: 991.98px) {
      .cascading-left {
        margin-left: 0px;
      }
      section {
        margin-top: 0px;
      }
    }
  </style>
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function(){
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

