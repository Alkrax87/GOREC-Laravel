<form action="{{ route('bienes.destroy', $bien->idBienes) }}" method="POST">
    {{ method_field('delete') }}
    {{ csrf_field() }}
    <div class="modal fade" id="ModalDeletebien{{$bien->idBienes}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-users-cog"></i> Eliminar bien</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            ¿Estas seguro de borrar el bien <b>{{ $bien->nombre_bienes}}</b>?
            <div class="row">
              <div class="col-12 pt-3 text-center">
                <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                <button type="submit" class="btn btn-danger mx-1"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp; Eliminar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>