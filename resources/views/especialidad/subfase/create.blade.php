<form action="{{ route('subfase.store') }}" method="POST">
  @csrf
  <div class="modal fade" id="ModalSubFaseCreate{{ $fase->idFase }}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-tasks"></i> Agregar Sub Actividades</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-0">
          <div class="form-group">
            <input type="hidden" name="idFase" value="{{ $fase->idFase }}">
          </div>
          <button type="button" class="btn btn-success mb-2" onclick="addSubfase({{ $fase->idFase }})">
            <i class="fas fa-plus"></i>
          </button>
          <div id="subfases-container-{{ $fase->idFase }}">
            <div class="subfase">
              <div class="card border-dark mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8 form-outline mb-4">
                      <label class="form-label">Nombre</label>
                      <input type="text" name="subfases[0][nombreSubfase]" class="input-auth" required />
                    </div>
                    <div class="col-4 form-outline mb-4">
                      <label class="form-label">Avance (%)</label>
                      <div class="input-group">
                        <input type="number" value="0" class="form-control input-auth"
                          name="subfases[0][avance_por_usuario_realSubFase]" required min="0" max="100"
                          step="0.01">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 form-outline">
                      <label class="form-label">Fecha Inicio</label>
                      <input type="date" name="subfases[0][fechaInicioSubfase]" class="input-auth" required />
                    </div>
                    <div class="col-6 form-outline">
                      <label class="form-label">Fecha Final</label>
                      <input type="date" name="subfases[0][fechaFinalSubfase]" class="input-auth" required />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 py-2 text-center">
            <button class="btn btn-primary mx-1" data-dismiss="modal">
              <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
            </button>
            <button type="submit" class="btn btn-success mx-1">
              <i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  function addSubfase(faseId) {
    const container = document.getElementById('subfases-container-' + faseId);
    const index = container.children.length;
    const div = document.createElement('div');
    div.className = 'subfase';
    div.innerHTML = `
      <div class="card carf-new border-dark mb-0">
        <div class="card-body">
          <div class="row">
            <div class="col-8 form-outline mb-4">
              <label class="form-label">Nombre Sub Actividad</label>
              <input type="text" name="subfases[${index}][nombreSubfase]" class="input-auth" required/>
            </div>
            <div class="col-4 form-outline mb-4">
              <label class="form-label">Avance (%)</label>
              <div class="input-group">
                <input type="number" value="0" name="subfases[${index}][avance_por_usuario_realSubFase]" class="form-control input-auth" required min="0" max="100" step="0.01">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 form-outline">
              <label class="form-label">Fecha Inicio</label>
              <input type="date" name="subfases[${index}][fechaInicioSubfase]" class="input-auth" required/>
            </div>
            <div class="col-6 form-outline">
              <label class="form-label">Fecha Final</label>
              <input type="date" name="subfases[${index}][fechaFinalSubfase]" class="input-auth" required/>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-danger delete w-100 mb-3" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);
  }

  function removeElement(element) {
    element.parentNode.remove();
  }
</script>
<style>
  .carf-new {
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
  }

  .delete {
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
  }
</style>
