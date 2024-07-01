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
              <b>CUI:</b>&nbsp; {{ $inversion->cuiInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Nombre:</b>&nbsp; {{ $inversion->nombreInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Nombre Corto:</b>&nbsp; {{ $inversion->nombreCortoInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Nivel:</b>&nbsp; {{ $inversion->nivelInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Jefe:</b>&nbsp; {{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}
            </div>
            <div class="col-12 py-2">
              <b>Provincia:</b>&nbsp; {{ $inversion->provinciaInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Distrito:</b>&nbsp; {{ $inversion->distritoInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Función:</b>&nbsp; {{ $inversion->funcionInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Fecha Inicio:</b>&nbsp; {{ $inversion->fechaInicioInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Fecha Final:</b>&nbsp; {{ $inversion->fechaFinalInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Formulación:</b>&nbsp; {{ $inversion->presupuestoFormulacionInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Ejecución:</b>&nbsp; {{ $inversion->presupuestoEjecucionfuncionInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Modalidad Ejecución:</b>&nbsp; {{ $inversion->modalidadEjecucionInversion }}
            </div>
            <div class="col-12 py-2">
              <b>Estado:</b>&nbsp; {{ $inversion->estadoInversion }}
            </div>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>