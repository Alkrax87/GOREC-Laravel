<form action="{{ route('asignaciones.show', $inversion->idInversion) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalShow{{$inversion->idInversion}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-eye"></i> Detalle Asignacion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <h2>{{ $inversion->nombreInversion }}</h2>
                <h6>{{ $inversion->cuiInversion }}</h6>
                <hr>
                @foreach ($profesionales as $profesional)
                  <div class="card mb-0">
                    <div class="card-header">
                      {{ $profesional->usuario->email }}
                    </div>
                    <div class="card-body py-0">
                      <blockquote class="blockquote mb-0">
                        <b>{{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}</b>
                        <p>Asistentes:</p>
                        @foreach ($asistentes->where('idJefe', $profesional->usuario->idUsuario) as $asistente)
                          <footer class="blockquote-footer">{{ $asistente->usuario->apellidoUsuario . ' ' . $asistente->usuario->nombreUsuario }}</footer>
                        @endforeach
                      </blockquote>
                    </div>
                  </div>
                  <br>
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
</form>

<style>
  blockquote {
    border-left-color: brown;
  }
</style>