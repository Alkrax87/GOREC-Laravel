<form action="{{ route('segmento.show', $segmento->idSegmento) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalShow{{$segmento->idSegmento}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-stream"></i> Detalle Segmento</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 py-2">
                <b>Nombre:</b>&nbsp; {{ $segmento->nombreSegmento }}
              </div>
              <div class="col-12 py-2">
                <b>Fecha Inicio:</b>&nbsp; {{ $segmento->fechaInicioSegmento }}
              </div>
              <div class="col-12 py-2">
                <b>Fecha Final:</b>&nbsp; {{ $segmento->fechaFinalSegmento }}
              </div>
              <div class="col-12 py-2">
                <b>Inversión:</b>&nbsp; {{ $segmento->inversion->nombreInversion }}
              </div>
              <div class="col-12 py-2">
                <b>Usuario:</b>&nbsp; {{ $segmento->usuario->nombreUsuario . ' ' . $segmento->usuario->apellidoUsuario }}
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