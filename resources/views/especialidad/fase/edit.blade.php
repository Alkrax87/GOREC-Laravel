<form action="{{ route('fase.update', $fase->idFase) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="modal fade" id="ModalEditFase{{ $fase->idFase }}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-briefcase"></i> Editar Actividad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-outline mb-4">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombreFase" value="{{ $fase->nombreFase }}" class="input-auth" placeholder="Nombre Actividad" required />
            </div>
            <div class="col-12 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal">
                <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
              </button>
              <button type="submit" class="btn btn-warning mx-1">
                <i class="fas fa-edit"></i>&nbsp;&nbsp; Editar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
