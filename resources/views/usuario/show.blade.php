@extends('adminlte::page')

@section('title', 'Detalle Usuario')

@section('content_header')
  <h1><i class="fas fa-eye"></i> Detalle Usuario "{{ $usuario->nombreUsuario . " " . $usuario->apellidoUsuario }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
        <div class="row">
            <div class="col-12 py-2">
              <b><i class="fas fa-user"></i> Nombres y Apellidos:</b>&nbsp; {{ $usuario->nombreUsuario . " " . $usuario->apellidoUsuario }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-user-shield"></i> Usuario:</b>&nbsp; {{ str_replace('@gorec.com', '', $usuario->email) }}
            </div>
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
            @if ($usuario->inversion->isNotEmpty())
              <div class="col-12 mt-2">
                <div class="card text-white bg-dark">
                  <div class="card-body pb-0">
                    <div class="col-12">
                      <b><i class="fas fa-clipboard-list"></i> Responsable en ({{ $usuario->inversion->unique('idInversion')->count() }}):</b>
                      <ul>
                        @foreach ($usuario->inversion->unique('idInversion') as $inversion)
                          <li>{{ $inversion->nombreCortoInversion }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            @if ($usuario->asignacionesProfesional->isNotEmpty())
              <div class="col-12 mt-2">
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
              <div class="col-12 mt-2">
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
              <div class="col-12 mt-2">
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
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@stop
