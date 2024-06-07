<form action="{{ route('inversion.destroy', $inversion->idInversion) }}" method="POST">
  {{ method_field('delete') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalDelete{{$inversion->idInversion}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Eliminar Inversión</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          ¿Estas seguro de borrar la inversión <b>{{ $inversion->nombreCortoInversion }}</b>?
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