<form action="{{ route('complementario.show', $complementario->idEstudiosComplementarios) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalShow{{$complementario->idEstudiosComplementarios}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-window-restore"></i> Detalle Complementario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 py-2">
              <b><i class="fas fa-file-signature"></i> Complementario:</b>&nbsp; {{ $complementario->nombreEstudiosComplementarios}}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-search"></i> Observación:</b>&nbsp; {{ $complementario->observacionEstudiosComplementarios}}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-stream"></i> Estado:</b>&nbsp; {{ $complementario->estadoEstudiosComplementarios}}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Fecha Inicio:</b>&nbsp; {{ $complementario->fechaInicioEstudiosComplementarios}}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Fecha Final:</b>&nbsp; {{ $complementario->fechaFinalEstudiosComplementarios}}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-file-signature"></i> Inversión:</b>&nbsp; {{ $complementario->inversion->nombreInversion}}
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
</form>