<form action="{{ route('complementario.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-window-restore"></i> Crear Complementario</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombre Estudio</label>
                <input type="text" name="nombreEstudiosComplementarios" class="form-control" placeholder="Ingrese Estudio" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Observación</label>
                <textarea class="form-control" name="observacionEstudiosComplementarios" placeholder="Ingrese Observación" rows="4" required></textarea>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Estado</label>
                <select id="Estado" name="estadoEstudiosComplementarios" class="form-select">
                  <option value="">Seleccione un Estado</option>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Atendido">Atendido</option>
                  <option value="Paralizado">Paralizado</option>
              </select>
              </div>
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
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioEstudiosComplementarios" class="form-control" required/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalEstudiosComplementarios" class="form-control" required/>
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
<!-- Incluir el JS de jQuery y Select2 -->
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