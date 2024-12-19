<div class="modal fade text-left" id="ModalLog{{ $subfase->idSubfase }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Registro de cambios de avance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>{{ $subfase->nombreSubfase }}</h3>
        <div class="container-fluid px-0 pt-3">
          @foreach ($logs as $log)
            <div class="card">
              <div class="card-header">
                <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $log->fechaCambioAvance }}
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <b><i class="fas fa-info"></i> Avance Anterior:</b>&nbsp; {{ $log->avanceSubfaseOLD }}
                  </div>
                  <div class="col-6">
                    <b><i class="fas fa-info"></i> Avance Cambiado:</b>&nbsp; {{ $log->avanceSubfaseNEW }}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
