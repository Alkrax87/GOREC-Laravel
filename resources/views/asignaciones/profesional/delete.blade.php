<form action="{{ route('asignaciones.destroy', $profesional->idUsuario) }}" method="POST">
  {{ method_field('delete') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalDelete{{ $inversion->idInversion . '-' . $profesional->idUsuario }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar Profesional</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" value="{{ $inversion->idInversion }}" name="idInversion" class="input-auth" required/>
        <input type="hidden" value="{{ $profesional->idUsuario }}" name="idUsuario" class="input-auth" required/>
        <div class="modal-body">
          ¿Estas seguro de borrar al profesional <b>{{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}</b>?
          <hr>
          <div class="row">
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-danger mx-1"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp; Eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>