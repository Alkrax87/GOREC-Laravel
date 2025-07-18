<div class="modal fade" id="ModalAsistentes{{ $inversion->idInversion }}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-users-cog"></i> Asistentes</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- Titulo -->
            <div class="col-12 py-2">
              <h2>{{ $inversion->nombreCortoInversion }}</h2>
              <h6>{{ $inversion->cuiInversion }}</h6>
            </div>
            <!-- Contenido -->
            <div class="col-12">
              <!-- Alert 
              @if ($message = Session::get('asistente_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
                </div>
              @endif-->
              <!-- Agregar -->
              <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreateAsistente{{ $inversion->idInversion }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Asistente</button>
              <!-- Tabla -->
              <div class="table-responsive">
                <table id="asistentesTable" class="table table-striped w-100">
                  <thead class="table-header">
                    <tr>
                      <th><i class="fas fa-user-tie"></i> Proyectistas</th>
                      <th><i class="fas fa-users-cog"></i> Asistente</th>
                      <th class="text-center w-25">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($asistentes as $asistente)
                      <tr>
                        <td>{{ $asistente->jefe->nombreUsuario . ' ' . $asistente->jefe->apellidoUsuario }}
                          <br>
                          <b>P:</b> (
                          @if ($asistente->jefe->profesiones->isNotEmpty())
                            @foreach ($asistente->jefe->profesiones as $profesion)
                              {{ $profesion->nombreProfesion }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                          <br>
                          <b>E:</b> (
                          @if ($asistente->jefe->especialidades->isNotEmpty())
                            @foreach ($asistente->jefe->especialidades as $especialidad)
                              {{ $especialidad->nombreEspecialidad }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                        </td>
                        
                        <td>
                          {{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}
                          <br>
                          <b>P:</b> (
                          @if ($asistente->usuario->profesiones->isNotEmpty())
                            @foreach ($asistente->usuario->profesiones as $profesion)
                              {{ $profesion->nombreProfesion }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                          <br>
                          <b>E:</b> (
                          @if ($asistente->usuario->especialidades->isNotEmpty())
                            @foreach ($asistente->usuario->especialidades as $especialidad)
                              {{ $especialidad->nombreEspecialidad }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                        </td>
                        <td class="text-center" style="white-space: nowrap">
                          <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteAsistente{{ $inversion->idInversion . '-' . $asistente->idAsistente . '-' . $asistente->idJefe }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @include('asignaciones.asistente.create')
              </div>
            </div>
            <div class="col-12 pt-4 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
        @foreach ($asistentes as $asistente)
          @include('asignaciones.asistente.delete', ['asistente' => $asistente])
        @endforeach
      </div>
    </div>
  </div>
</div>