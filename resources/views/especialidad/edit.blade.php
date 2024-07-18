<form action="{{ route('especialidad.update', $especialidad->idEspecialidad) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade" id="ModalEditEspecialidad{{ $especialidad->idEspecialidad}}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Actualizar Especialidad</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-outline mb-4">
                            <label class="form-label">Nombre Especialidad</label>
                            <input type="text" name="nombreEspecialidad" value="{{ $especialidad->nombreEspecialidad }}" class="input-auth" required/>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Especialista</label>
                            <button type="button" class="btn btn-success btn-sm mb-2" onclick="addUsuarioEdit({{ $especialidad->idEspecialidad }})"><i class="fas fa-plus"></i></button>
                            <div id="usuarios-container-edit-{{ $especialidad->idEspecialidad }}">
                                @foreach ($especialidad->usuarios as $usuario)
                                <div class="input-group mb-2">
                                    <select name="idUsuario[]" class="form-select form-select-sm input-auth" required>
                                        <option value="" disabled>Selecciona un usuario</option>
                                        @foreach ($usuarios as $user)
                                            <option value="{{ $user->idUsuario }}" {{ $user->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>{{ $user->nombreUsuario . ' ' . $user->apellidoUsuario }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="porcentajeAvanceEspecialidad">Avance Porcentaje Programado(%)</label>
                            <input type="number" name="porcentajeAvanceEspecialidad" value="{{ $especialidad->porcentajeAvanceEspecialidad }}" class="form-control" required min="0" max="100" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // JavaScript para manejar la edición de profesiones y especialidades
    function addUsuarioEdit(usuarioId) {
      const container = document.getElementById('usuarios-container-edit-' + usuarioId);
      const div = document.createElement('div');
      div.className = 'input-group mb-2';
      div.innerHTML = `
        @foreach ($especialidad->usuarios as $usuario)
        <div class="input-group mb-2">
            <select name="idUsuario[]" class="form-select form-select-sm input-auth" required>
                <option value="" disabled selected>Selecciona un usuario</option>
                @foreach ($usuarios as $user)
                    <option value="{{ $user->idUsuario }}">{{ $user->nombreUsuario . ' ' . $user->apellidoUsuario }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
        </div>
        @endforeach
      `;
      container.appendChild(div);
    }
    function removeElement(element) {
    element.parentNode.remove();
  }
  </script>