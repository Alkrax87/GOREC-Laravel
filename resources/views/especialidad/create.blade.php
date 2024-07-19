<form action="{{ route('especialidad.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-users-cog"></i> Crear Especialidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                <select name="idInversion" id="idInversion" class="form-select form-select-sm input-auth" required>
                  <option value="" disabled selected>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}">
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="row">
                <div class="col-8 form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombreEspecialidad" class="input-auth" required />
                </div>
                <div class="col-4 form-outline mb-4">
                  <label class="form-label">Porcentaje Programado</label>
                  <div class="input-group">
                    <input type="number" class="form-control input-auth" value="0" name="porcentajeAvanceEspecialidad" required min="0" max="100" step="0.01">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Encargados</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addUsuarios()"><i class="fas fa-plus"></i></button>
                <div id="profesiones-container">
                  <div class="input-group mb-2">
                    <select name="idUsuario[]" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona un usuario</option>
                      @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->idUsuario }}">
                          {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                        </option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
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
  </div>
</form>

<style>
  .input-auth {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: all 0.3s ease-in-out;
  }
  .input-auth:focus {
    border-color: #72081f;
    outline: none;
    box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
  }
  .input-autht:focus::placeholder {
    color: transparent;
  }
</style>

<script>
  function addUsuarios() {
  const container = document.getElementById('profesiones-container');
  const div = document.createElement('div');
  div.className = 'input-group mb-2';
  div.innerHTML = `
    <select name="idUsuario[]" class="form-select form-select-sm input-auth" required>
      <option value="" disabled selected>Selecciona un usuario</option>
      @foreach ($usuarios as $usuario)
        <option value="{{ $usuario->idUsuario }}">
          {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
        </option>
      @endforeach
    </select>
    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
  `;
  container.appendChild(div);
  }
  function removeElement(element) {
    element.parentNode.remove();
  }
</script>