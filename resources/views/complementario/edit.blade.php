<form action="{{ route('complementario.update', $complementario->idEstudiosComplementarios) }}" method="POST">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalEdit{{$complementario->idEstudiosComplementarios}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-window-restore"></i> Editar Complementario</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombreEstudiosComplementarios" value="{{ $complementario->nombreEstudiosComplementarios  }}" class="form-control" placeholder="Nombre Segmento" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Observación</label>
                <textarea class="form-control" name="observacionEstudiosComplementarios" placeholder="Ingrese Observación" rows="4" required>{{ $complementario->observacionEstudiosComplementarios}}</textarea>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Estado</label>
                <select id="Estado" name="estadoEstudiosComplementarios" class="form-select">
                  <option value="">Seleccione un Estado</option>
                  <option value="Pendiente" {{ $complementario->estadoEstudiosComplementarios == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                  <option value="Atendido" {{ $complementario->estadoEstudiosComplementarios == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                  <option value="Paralizado" {{ $complementario->estadoEstudiosComplementarios == 'Paralizado' ? 'selected' : '' }}>Paralizado</option>
                </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                <select name="idInversion" id="idInversions{{$complementario->idEstudiosComplementarios}}" class="form-select" required>
                  <option value="" disabled>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}" {{ $complementario->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioEstudiosComplementarios" value="{{ $complementario->fechaInicioEstudiosComplementarios}}" class="form-control" placeholder="Nombre Segmento" required/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalEstudiosComplementarios" value="{{ $complementario->fechaFinalEstudiosComplementarios}}" class="form-control" placeholder="Nombre Segmento" required/>
                </div>
              </div>
            </div>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    $('#ModalEdit{{$complementario->idEstudiosComplementarios}}').on('shown.bs.modal', function () {
      $('#idInversions{{$complementario->idEstudiosComplementarios}}').select2({
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
    $('#ModalEdit{{$complementario->idEstudiosComplementarios}}').on('hidden.bs.modal', function () {
      $('#idInversions{{$complementario->idEstudiosComplementarios}}').select2('destroy');
    });
  });
</script>