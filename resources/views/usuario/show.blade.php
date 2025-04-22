@extends('adminlte::page')

@section('title', 'Usuario • Detalle')

@section('content_header')
  <h1><i class="fas fa-eye"></i> Detalle Usuario: "{{ $usuario->nombreUsuario . " " . $usuario->apellidoUsuario }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 py-2">
          <b><i class="fas fa-user"></i> Nombres y Apellidos:</b>&nbsp; {{ $usuario->nombreUsuario . " " . $usuario->apellidoUsuario }}
        </div>
        @if ($usuario->email)
          <div class="col-12 py-2">
            <b><i class="fas fa-user-shield"></i> Usuario:</b>&nbsp; {{ str_replace('@gorec.com', '', $usuario->email) }}
          </div>
        @endif
        @if ($usuario->categoriaUsuario)
          <div class="col-12 py-2">
            <b><i class="fas fa-clipboard-list"></i> Categoría:</b>&nbsp; {{ $usuario->categoriaUsuario }}
          </div>
        @endif
        @if ($usuario->profesiones->isNotEmpty())
          <div class="col-12 mt-2">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-user-graduate"></i> Profesión:</b>
                  <ul>
                    @foreach ($usuario->profesiones as $profesion)
                      <li>{{ $profesion->nombreProfesion }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($usuario->especialidades->isNotEmpty())
          <div class="col-12">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-user-cog"></i> Especialidad:</b>
                  <ul>
                    @foreach ($usuario->especialidades as $especialidad)
                      <li>{{ $especialidad->nombreEspecialidad }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($usuario->inversiones->isNotEmpty())
          <div class="col-12">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-clipboard-list"></i> Responsable en ({{ $usuario->inversiones->unique('idInversion')->count() }}):</b>
                  <ul>
                    @foreach ($usuario->inversiones->unique('idInversion') as $inversion)
                      <li>{{ $inversion->nombreCortoInversion }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($usuario->asignacionesProfesional->isNotEmpty())
          <div class="col-12">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-user-tie"></i> Profesional en ({{ $usuario->asignacionesProfesional->unique('idInversion')->count() }}):</b>
                  <ul>
                    @foreach ($usuario->asignacionesProfesional->unique('idInversion') as $asignacion)
                      <li>{{ $asignacion->inversion->nombreCortoInversion  }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($usuario->asignacionesAsistente->isNotEmpty())
          <div class="col-12">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-users-cog"></i> Asistente en ({{ $usuario->asignacionesAsistente->unique('idInversion')->count() }}):</b>
                  <ul>
                    @foreach ($usuario->asignacionesAsistente->unique('idInversion') as $asignacion)
                      <li>{{ $asignacion->inversion->nombreCortoInversion }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if ($usuario->asignacionesAsistente->isNotEmpty())
          <div class="col-12">
            <div class="card text-white bg-dark">
              <div class="card-body pb-0">
                <div class="col-12">
                  <b><i class="fas fa-eye"></i> Observación:</b>
                  <ul style="text-align: justify;">
                    @if (is_null($usuario->ObservacionUser))
                      Ninguna Observación
                    @else
                      {{ $usuario->ObservacionUser }}
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif
        <div class="col-12 py-2 text-center">
          <a href="{{ url()->previous() }}" type="button" class="btn btn-primary"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</a>
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
@stop