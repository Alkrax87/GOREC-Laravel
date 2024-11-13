<div class="modal fade text-left" id="ModalShow{{$inversion->idInversion}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-eye"></i> Detalle Asignación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h2>{{ $inversion->nombreCortoInversion }}</h2>
              <p><h5><i class="fas fa-portrait"></i> Responsable: <span style="font-size: 16px">{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</span></h5> </p>
              @if (Auth::user()->isAdmin || Auth::user()->idUsuario === $inversion->usuario->idUsuario)
                <h4><i class="fas fa-user-tie"></i> Profesionales</h4>
                @foreach ($profesionales as $profesional)
                  <div class="card border-danger">
                    <div class="card-header bg-danger">
                      <b><i class="fas fa-user-tie"></i> {{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}</b>
                    </div>
                    <div class="card-body pb-0">
                      <div class="row">
                        <div class="col-6">
                          <b><i class="fas fa-user-graduate"></i> Profesiones</b>
                          @if ($profesional->usuario->profesiones->isNotEmpty())
                            <ul>
                              @foreach ($profesional->usuario->profesiones as $profesion)
                                <li class="fw-normal">{{ $profesion->nombreProfesion }}</li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                        <div class="col-6">
                          <b><i class="fas fa-user-cog"></i> Especialidad:</b>
                          @if ($profesional->usuario->especialidades->isNotEmpty())
                            <ul>
                              @foreach ($profesional->usuario->especialidades as $especialidad)
                                <li class="fw-normal">{{ $especialidad->nombreEspecialidad }}</li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                      </div>
                      <hr class="mt-0">
                      <h5><i class="fas fa-users-cog"></i> Asistentes</h5>
                      @foreach ($asistentes->where('idJefe', $profesional->usuario->idUsuario) as $asistente)
                        <div class="card text-white bg-dark mb-3">
                          <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-users-cog"></i> {{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}</span>
                            <a class="btn btn-warning ms-auto" data-toggle="modal" data-target="#Modalobservacion{{ $asistente->usuario->idUsuario }}{{ $inversion->idInversion }}">
                              <i class="fas fa-user-cog"></i>
                            </a>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-6">
                                <b><i class="fas fa-user-graduate"></i> Profesiones:</b>
                                @if ($asistente->usuario->profesiones->isNotEmpty())
                                  <ul>
                                    @foreach ($asistente->usuario->profesiones as $profesion)
                                      <li class="fw-normal">{{ $profesion->nombreProfesion }}</li>
                                    @endforeach
                                  </ul>
                                @endif
                              </div>
                              <div class="col-6">
                                <b><i class="fas fa-user-cog"></i> Especialidad:</b>
                                @if ($asistente->usuario->especialidades->isNotEmpty())
                                  <ul>
                                    @foreach ($asistente->usuario->especialidades as $especialidad)
                                      <li class="fw-normal">{{ $especialidad->nombreEspecialidad }}</li>
                                    @endforeach
                                  </ul>
                                @endif
                              </div>
                              <div class="col-12">
                                <b><i class="fas fa-eye"></i> Observación:</b>
                                <ul style="text-align: justify;">
                                  @if(is_null($asistente->usuario->ObservacionUser))
                                    Ninguna Observación
                                  @else
                                    {{ $asistente->usuario->ObservacionUser }}
                                  @endif
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              @else
                {{-- Mostrar solo la tarjeta del jefe autenticado --}}
                <h4><i class="fas fa-user-tie"></i> Profesionales</h4>
                <div class="card border-danger">
                  <div class="card-header bg-danger">
                    <b><i class="fas fa-user-tie"></i> {{ Auth::user()->nombreUsuario . ' ' . Auth::user()->apellidoUsuario }}</b>
                  </div>
                  <div class="card-body pb-0">
                    <div class="row">
                      <div class="col-6">
                        <b><i class="fas fa-user-graduate"></i> Profesiones</b>
                        @if (Auth::user()->profesiones->isNotEmpty())
                          <ul>
                            @foreach (Auth::user()->profesiones as $profesion)
                              <li class="fw-normal">{{ $profesion->nombreProfesion }}</li>
                            @endforeach
                          </ul>
                        @endif
                      </div>
                      <div class="col-6">
                        <b><i class="fas fa-user-cog"></i> Especialidad:</b>
                        @if (Auth::user()->especialidades->isNotEmpty())
                          <ul>
                            @foreach (Auth::user()->especialidades as $especialidad)
                              <li class="fw-normal">{{ $especialidad->nombreEspecialidad }}</li>
                            @endforeach
                          </ul>
                        @endif
                      </div>
                    </div>
                    <hr class="mt-0">
                    <h5><i class="fas fa-users-cog"></i> Asistentes</h5>
                    @foreach ($asistentes->where('idJefe', Auth::user()->idUsuario) as $asistente)
                      <div class="card text-white bg-dark mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <span><i class="fas fa-users-cog"></i> {{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}</span>
                          <a class="btn btn-warning ms-auto" data-toggle="modal" data-target="#Modalobservacion{{ $asistente->usuario->idUsuario }}{{ $inversion->idInversion }}">
                            <i class="fas fa-user-cog"></i>
                          </a>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6">
                              <b><i class="fas fa-user-graduate"></i> Profesiones:</b>
                              @if ($asistente->usuario->profesiones->isNotEmpty())
                                <ul>
                                  @foreach ($asistente->usuario->profesiones as $profesion)
                                    <li class="fw-normal">{{ $profesion->nombreProfesion }}</li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>
                            <div class="col-6">
                              <b><i class="fas fa-user-cog"></i> Especialidad:</b>
                              @if ($asistente->usuario->especialidades->isNotEmpty())
                                <ul>
                                  @foreach ($asistente->usuario->especialidades as $especialidad)
                                    <li class="fw-normal">{{ $especialidad->nombreEspecialidad }}</li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>
                            <div class="col-12">
                              <b><i class="fas fa-eye"></i> Observación:</b>
                              <ul style="text-align: justify;">
                                @if(is_null($asistente->usuario->ObservacionUser))
                                  Ninguna Observación
                                @else
                                  {{ $asistente->usuario->ObservacionUser }}
                                @endif
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Incluye los modales de observación fuera del ciclo `foreach` de inversión pero dentro del modal principal -->
@foreach ($asistentes as $asistente)
    @include('asignaciones.observacion', ['asistente' => $asistente, 'inversion' => $inversion])
@endforeach