<div class="modal fade" id="ModalProfesional{{ $inversion->idInversion }}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-user-tie"></i> Profesionales</h3>
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
              @if ($message = Session::get('profesional_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
                </div>
              @endif
              @if ($error = Session::get('error'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p class="alert-message mb-0"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; {{ $error }}</p>
                </div>
              @endif -->
              <!-- Agregar -->
              <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate{{ $inversion->idInversion }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Profesional</button>
              <!-- Tabla -->
              <div class="table-responsive">
                <table  class="table table-striped w-100">
                  <thead class="table-header">
                    <tr>
                      <th class="w-75"><i class="fas fa-user-tie"></i> Profesional</th>
                      <th class="text-center w-25">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($profesionales as $profesional)
                      <tr>
                        <td>
                          {{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}
                          <br>
                          <b>P:</b> (
                          @if ($profesional->usuario->profesiones->isNotEmpty())
                            @foreach ($profesional->usuario->profesiones as $profesion)
                              {{ $profesion->nombreProfesion }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                          <br>
                          <b>E:</b> (
                          @if ($profesional->usuario->especialidades->isNotEmpty())
                            @foreach ($profesional->usuario->especialidades as $especialidad)
                              {{ $especialidad->nombreEspecialidad }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )
                        </td>
                        <td class="text-center" style="white-space: nowrap">
                          <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $inversion->idInversion . '-' . $profesional->idUsuario }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @include('asignaciones.profesional.create', ['inversion' => $inversion ])
              </div>
            </div>
            <div class="col-12 pt-4 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
        @foreach ($profesionales as $profesional)
          @include('asignaciones.profesional.delete', ['profesional' => $profesional])
        @endforeach
      </div>
    </div>
  </div>
</div>