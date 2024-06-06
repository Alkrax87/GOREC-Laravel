<form action="{{ route('asignaciones.show', $inversion->idInversion) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalShow{{$inversion->idInversion}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detalle Inversión</h4>
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
                  <div class="card">
                    <div class="card-header">
                      {{ $profesional->usuario->email }}
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <p>{{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}</p>
                        <footer class="blockquote-footer">Profesión: <cite>{{ $profesional->usuario->profesionUsuario }}</cite></footer>
                        <footer class="blockquote-footer">Especialidad: <cite>{{ $profesional->usuario->especialidadUsuario }}</cite></footer>
                      </blockquote>
                    </div>
                  </div>
                  <br>
                @endforeach
              </div>
              <div class="col-12 py-2 text-center">
                <hr>
                <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>