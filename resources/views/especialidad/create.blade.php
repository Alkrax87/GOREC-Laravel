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
                <label class="form-label">Inversión</label>
                <select name="idInversion" id="idInversion-create" class="form-select"
                  required>
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
                  <label class="form-label">Nombre Especialidad</label>
                  <input type="text" name="nombreEspecialidad" class="form-control" placeholder="Ingrese Especialidad"
                    required />
                </div>
                <div class="col-4 form-outline mb-4">
                  <label class="form-label">Porcentaje Programado</label>
                  <div class="input-group">
                    <input type="number" class="form-control" value="0"
                      name="porcentajeAvanceEspecialidad" required min="0" max="100" step="0.01">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Proyectistas</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addUsuariosCreate()"><i
                    class="fas fa-plus"></i></button>
                <div id="usuarios-container-create">
                  <div class="input-group mb-2">
                    <select name="idUsuario[]" class="form-select" required
                      id="usuariosSelect-create">
                      <option value="" disabled selected>Selecciona un usuario</option>
                      <!-- Aquí se llenarán los usuarios dinámicamente -->
                    </select>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i
                        class="fas fa-trash-alt"></i></button>
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

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Ejecutar cuando el modal se muestra
    $('#ModalCreate').on('shown.bs.modal', function() {
      // Inicializar select2 en el select de inversión
      $('#idInversion-create').select2({
        placeholder: "Selecciona una inversión",
        allowClear: true,
        language: {
          noResults: function() {
            return "No se encontró la inversión";
          }
        }
      });
      // Añadir el event listener al select de inversión solo una vez
      if (!$('#idInversion-create').data('listener-added')) {
        // Evento para manejar el cambio de selección en el select de inversión
        $('#idInversion-create').on('change', function() {
          const inversionId = this.value; // Obtener el ID de la inversión seleccionada
          const usuariosSelect = document.getElementById(
          'usuariosSelect-create'); // Obtener el select de usuarios
          usuariosSelect.innerHTML =
          '<option value="" disabled selected>Selecciona un usuario</option>'; // Limpiar el select de usuarios
          // Realizar una solicitud fetch para obtener los usuarios según la inversión seleccionada
          fetch(`/usuarios-por-inversion/${inversionId}`)
            .then(response => {
              if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
              }
              return response.json();
            })
            .then(usuarios => {
              usuarios.forEach(usuario => {
                const option = document.createElement('option');
                option.value = usuario.idUsuario;
                // Construir el texto del option con profesiones y especialidades
                const profesiones = usuario.profesiones.map(p => p.nombreProfesion).join(', ');
                const especialidades = usuario.especialidades.map(e => e.nombreEspecialidad).join(
                  ', ');
                option.innerHTML =
                  `${usuario.nombreUsuario} ${usuario.apellidoUsuario} => P: (${profesiones}) &nbsp; | &nbsp; E: (${especialidades})`;
                usuariosSelect.appendChild(option); // Añadir el option al select de usuarios
              });
              // Actualizar todos los selects de usuarios en el contenedor
              const allUserSelects = document.querySelectorAll(
                '#usuarios-container-create select[name="idUsuario[]"]');
              allUserSelects.forEach(select => {
                if (select !== usuariosSelect) {
                  select.innerHTML = usuariosSelect.innerHTML;
                }
              });
            })
            .catch(error => console.error('Error al cargar los usuarios:', error));
        });
        $('#idInversion-create').data('listener-added', true); // Marcar el event listener como añadido
      }
    });

    // Destruir el select2 en el select de inversión cuando se cierra el modal
    $('#ModalCreate').on('hidden.bs.modal', function() {
      $('#idInversion-create').select2('destroy');
    });
  });

  // Función para añadir un nuevo select de usuarios
  function addUsuariosCreate() {
    const container = document.getElementById('usuarios-container-create'); // Obtener el contenedor de usuarios
    const div = document.createElement('div'); // Crear un nuevo div para contener el select y el botón de eliminar
    div.className = 'input-group mb-2'; // Asignar clases al div
    const usuariosSelect = document.getElementById('usuariosSelect-create'); // Obtener el select de usuarios principal
    const newSelect = usuariosSelect.cloneNode(true); // Clonar el select principal
    newSelect.id = ''; // Eliminar el id del nuevo select clonado
    div.appendChild(newSelect); // Añadir el nuevo select al div
    div.innerHTML +=
      `<button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>`; // Añadir un botón para eliminar el div
    container.appendChild(div); // Añadir el div al contenedor de usuarios
  }

  function removeElement(element) {
    element.parentNode.remove();
  }
</script>