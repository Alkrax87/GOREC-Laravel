<form action="{{ route('subfase.update', $subfase->idSubfase) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="modal fade" id="ModalEditSubFase{{ $subfase->idSubfase}}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-tasks"></i> Editar Sub Actividad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-9 form-outline mb-4">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombreSubfase" value="{{ $subfase->nombreSubfase }}" class="input-auth" required">
            </div>
            <div class="col-3 form-outline mb-4">
              <label class="form-label">Avance (%)</label>
              <input type="number" name="avance_por_usuario_realSubFase" value="{{ $subfase->avance_por_usuario_realSubFase}}" class="input-auth" required min="0" max="100" step="0.01">
            </div>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>