<form action="{{ route('fase.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalCreateFase{{ $especialidad->idEspecialidad }}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-briefcase"></i> Nueva Actividad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body pt-0">
            @if ($errors->any())
              <div class="alert alert-danger">
                <b>Error!</b> Por favor corrige los errores en el formulario.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="row">
              <div class="col-12">
                <div class="form-outline mb-4">
                  <input type="hidden" name="idEspecialidad" value="{{ $especialidad->idEspecialidad }}">
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre Actividad</label>
                  <input type="text" name="nombreFase" class="form-control input-auth" required />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Porcentaje Programado</label>
                  <div class="input-group">
                    <input type="number" class="form-control input-auth" value="0" name="porcentajeAvanceFase" required min="0" max="100" step="0.01">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="col-12 py-2 text-center">
                <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</form>
