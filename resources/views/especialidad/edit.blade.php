<form action="{{ route('especialidad.update', $especialidad->idEspecialidad) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="modal fade" id="ModalEditEspecialidad{{ $especialidad->idEspecialidad }}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-users-cog"></i> Editar Especialidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <!-- Inversión select -->
              <!--<div class="form-outline mb-4">
                <label class="form-label">Inversión</label>-->
                <select name="idInversion" id="idInversion-{{ $especialidad->idEspecialidad }}" class="form-select form-select-sm input-auth" required hidden>
                  <option value="" disabled>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}" {{ $especialidad->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                </select>
              <!--</div>-->
              
              <!-- Otros campos -->
              <div class="row">
                <div class="col-8 form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombreEspecialidad" value="{{ $especialidad->nombreEspecialidad }}" class="input-auth" required />
                </div>
                <div class="col-4 form-outline mb-4">
                  <label class="form-label">Avance Programado</label>
                  <div class="input-group">
                    <input type="number" class="form-control input-auth" name="porcentajeAvanceEspecialidad" value="{{ $especialidad->porcentajeAvanceEspecialidad }}" required min="0" max="100" step="0.01">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>

              <!-- Encargados -->
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Encargados</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addUsuarioEdit({{ $especialidad->idEspecialidad }})"><i class="fas fa-plus"></i></button>
                <div id="usuarios-container-edit-{{ $especialidad->idEspecialidad }}">
                  @foreach ($especialidad->usuarios as $usuario)
                    <div class="input-group mb-2">
                      <select name="idUsuario[]" class="form-select form-select-sm input-auth" required>
                        <option value="" disabled>Selecciona un usuario</option>
                        @foreach ($usuarios as $user)
                          <option value="{{ $user->idUsuario }}" {{ $user->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                            {{ $user->nombreUsuario . ' ' . $user->apellidoUsuario }}
                          </option>
                        @endforeach
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
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
  // Espera a que el DOM esté completamente cargado
  document.addEventListener('DOMContentLoaded', function() {
    // Obtiene el elemento select de inversiones basado en el ID de la especialidad
    const inversionSelect = document.getElementById('idInversion-' + {{ $especialidad->idEspecialidad }});
    // Obtiene el valor seleccionado en el select de inversiones
    const inversionId = inversionSelect.value;
    // Si hay una inversión seleccionada, carga los usuarios correspondientes
    if (inversionId) {
      loadUsuarios(inversionId);
    }
    // Función para cargar usuarios basados en el ID de la inversión
    function loadUsuarios(inversionId) {
      // Obtiene el contenedor de los selects de usuarios basado en el ID de la especialidad
      const usuariosContainer = document.getElementById('usuarios-container-edit-' + {{ $especialidad->idEspecialidad }});
      // Obtiene todos los selects de usuarios dentro del contenedor
      const usuariosSelects = usuariosContainer.querySelectorAll('select[name="idUsuario[]"]');
      // Guarda las opciones seleccionadas previamente en cada select
      const selectedOptions = Array.from(usuariosSelects).map(select => select.value);
      // Vacía todas las opciones de cada select
      usuariosSelects.forEach(select => {
        while (select.firstChild) {
          select.removeChild(select.firstChild);
        }
      });
      // Realiza una solicitud fetch para obtener los usuarios basados en el ID de la inversión
      fetch(`/usuarios-por-inversion/${inversionId}`)
        .then(response => response.json()) // Convierte la respuesta en formato JSON
        .then(usuarios => {
          console.log('Usuarios encontrados:', usuarios); // Muestra los usuarios en la consola
          // Añade las opciones de usuarios a cada select
          usuarios.forEach(usuario => {
            usuariosSelects.forEach(select => {
              const option = document.createElement('option');
              option.value = usuario.idUsuario;
               // Construye el texto del option con profesiones y especialidades específicas para cada usuario
        const profesiones = usuario.profesiones.map(p => p.nombreProfesion).join(', ');
        const especialidades = usuario.especialidades.map(e => e.nombreEspecialidad).join(', ');

        option.innerHTML = `${usuario.nombreUsuario} ${usuario.apellidoUsuario} =>
          P: (${profesiones})  &nbsp; | &nbsp;
          E: (${especialidades})`;
              select.appendChild(option);
            });
          });
          // Restaura las opciones seleccionadas previamente en cada select
          usuariosSelects.forEach((select, index) => {
            if (selectedOptions[index]) {
              select.value = selectedOptions[index];
            }
          });
        })
        .catch(error => console.error('Error al cargar los usuarios:', error)); // Maneja errores
    }

    // Función para añadir un nuevo select de usuario en el modo de edición
    window.addUsuarioEdit = function(especialidadId) {
      // Obtiene el contenedor de los selects de usuarios basado en el ID de la especialidad
      const container = document.getElementById('usuarios-container-edit-' + especialidadId);
      // Crea un nuevo div con la clase correspondiente
      const div = document.createElement('div');
      div.className = 'input-group mb-2';
      // Clona un select de usuario existente pero sin sus opciones
      const usuariosSelect = container.querySelector('select[name="idUsuario[]"]').cloneNode(false);
      usuariosSelect.innerHTML = '<option value="" disabled selected>Selecciona un usuario</option>';
      // Copia las opciones del select original al nuevo select
      const originalSelect = container.querySelector('select[name="idUsuario[]"]');
      Array.from(originalSelect.options).forEach(option => {
        const newOption = option.cloneNode(true);
        usuariosSelect.appendChild(newOption);
      });
      // Añade el nuevo select al div
      div.appendChild(usuariosSelect);
      // Añade un botón de eliminar al div
      div.innerHTML += `<button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>`;
      // Añade el div al contenedor
      container.appendChild(div);
    };

    // Función para eliminar un elemento del DOM
    function removeElement(element) {
      element.parentNode.remove();
    }
  });
</script>


<style>
  body {
    background-color: #000;
  }
  section {
    margin-top: 100px;
  }
  /* Others */
  .center-items {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  /* Card Style */
  .cascading-left {
    margin-left: -50px;
  }
  /* Input Style  */
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
  /* Btn Style  */
  .btn-gorec {
    width: 250px;
    height: 50px;
    background-color: #9C0C27;
    color: #fff;
    border-radius: 50px
  }
  .btn-gorec:hover {
    background-color: #72081f;
    color: #fff;;
  }
  /* Line */
  .line {
    border: 0;
    border-top: 1px solid #72081f;
    margin: 1rem 0;
    width: 50%;
  }
  /* Redirection */
  .login-direction {
    color: #72081f;
    text-decoration: none;
  }
  @media (max-width: 991.98px) {
    .cascading-left {
      margin-left: 0px;
    }
    section {
      margin-top: 0px;
    }
  }
</style>
