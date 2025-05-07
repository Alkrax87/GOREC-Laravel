<form action="{{ route('comentario.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-window-restore"></i> Crear Comentario</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                  <select name="idInversion" id="idInversion" class="form-select" required>
                    <option value="" disabled selected>Selecciona una inversión</option>
                    @foreach ($inversiones as $inversion)
                      <option value="{{ $inversion->idInversion }}">
                        {{ $inversion->nombreCortoInversion }}
                      </option>
                    @endforeach
                  </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Asunto Comentario</label>
                <input type="text" name="asuntoComentarioInversion" class="form-control" placeholder="Ingrese Asunto" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" name="comentariosInversion" placeholder="Ingrese Observación" rows="4" required></textarea>
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

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#ModalCreate').on('shown.bs.modal', function () {
      $('#idInversion').select2({
        placeholder: "Selecciona una inversion",
        allowClear: true,
          language: {
            noResults: function() {
              return "No se encontró la inversión";
            }
          }
      });
    });
    // Destruye Select2 cuando el modal se cierra para evitar problemas
    $('#ModalCreate').on('hidden.bs.modal', function () {
      $('#idInversion').select2('destroy');
    });
  });
</script>