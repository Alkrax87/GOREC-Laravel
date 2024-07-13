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
              <p><i class="fas fa-portrait"></i> <b>Jefe: </b>{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</p>
              <h4><i class="fas fa-user-tie"></i> Profesionales</h4>
              @foreach ($profesionales as $profesional)
                <div class="card border-danger">
                  <div class="card-header bg-danger">
                    <b><i class="fas fa-user-tie"></i> {{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}
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
                        <div class="card-header"><i class="fas fa-users-cog"></i> {{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}</div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6">
                              <b><i class="fas fa-user-graduate"></i> Profesiones</b>
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
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
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