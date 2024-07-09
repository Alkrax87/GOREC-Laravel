<form action="{{ route('inversion.show', $inversion->idInversion) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalShow{{$inversion->idInversion}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Detalle Inversión</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 py-2">
              <b><i class="fas fa-tag"></i> CUI:</b>&nbsp; {{ $inversion->cuiInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-file-signature"></i> Nombre:</b>&nbsp; {{ $inversion->nombreInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-file-signature"></i> Nombre Corto:</b>&nbsp; {{ $inversion->nombreCortoInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-portrait"></i> Jefe:</b>&nbsp; {{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-map-marker-alt"></i> Provincia:</b>&nbsp; {{ $inversion->provinciaInversion }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-map-marker-alt"></i> Distrito:</b>&nbsp; {{ $inversion->distritoInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-layer-group"></i> Nivel:</b>&nbsp; {{ $inversion->nivelInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-cogs"></i> Función:</b>&nbsp; {{ $inversion->funcionInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-stream"></i> Modalidad:</b>&nbsp; {{ $inversion->modalidadInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-info"></i> Estado:</b>&nbsp; {{ $inversion->estadoInversion }}
            </div>
            <div class="col-12 py-2">
              <b><i class="fas fa-percentage"></i> Avance:</b>&nbsp; {{ $inversion->avanceInversion }}%
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Fecha Inicio:</b>&nbsp; {{ $inversion->fechaInicioInversion }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-calendar-alt"></i> Fecha Final:</b>&nbsp; {{ $inversion->fechaFinalInversion }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-file-invoice-dollar"></i> Formulación:</b>&nbsp; {{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}
            </div>
            <div class="col-6 py-2">
              <b><i class="fas fa-file-invoice-dollar"></i> Ejecución:</b>&nbsp; {{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}
            </div>
            <div class="col-12 mt-4 text-center">
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>