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
                <select name="idInversion" id="idInversion-create" class="form-select form-select-sm input-auth" required>
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
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addUsuariosCreate()"><i class="fas fa-plus"></i></button>
                <div id="usuarios-container-create">
                  <div class="input-group mb-2">
                    <select name="idUsuario[]" class="form-select form-select-sm input-auth" required id="usuariosSelect-create">
                      <option value="" disabled selected>Selecciona un usuario</option>
                      <!-- Aquí se llenarán los usuarios dinámicamente -->
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

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Ejecutar cuando el modal se muestra
    $('#ModalCreate').on('shown.bs.modal', function () {
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
          const usuariosSelect = document.getElementById('usuariosSelect-create'); // Obtener el select de usuarios
          usuariosSelect.innerHTML = '<option value="" disabled selected>Selecciona un usuario</option>'; // Limpiar el select de usuarios
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
                const especialidades = usuario.especialidades.map(e => e.nombreEspecialidad).join(', ');
                option.innerHTML = `${usuario.nombreUsuario} ${usuario.apellidoUsuario} => P: (${profesiones}) &nbsp; | &nbsp; E: (${especialidades})`;
                usuariosSelect.appendChild(option); // Añadir el option al select de usuarios
              });
              // Actualizar todos los selects de usuarios en el contenedor
              const allUserSelects = document.querySelectorAll('#usuarios-container-create select[name="idUsuario[]"]');
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
    $('#ModalCreate').on('hidden.bs.modal', function () {
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
    div.innerHTML += `<button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>`; // Añadir un botón para eliminar el div
    container.appendChild(div); // Añadir el div al contenedor de usuarios
  }

  // Función para eliminar un elemento del DOM
  function removeElement(element) {
    element.parentNode.remove(); // Eliminar el elemento padre del elemento pasado como parámetro (el div contenedor)
  }
</script>


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
<style>

  .select2-container--default .select2-selection--single .select2-selection__rendered { 
      line-height: 24px;
      padding-left: 10px; /* Ajustar el padding izquierdo */
       /* Asegurar que el texto esté alineado a la izquierda */
    }
    .select2-container .select2-selection--single {
      height: 35px;
      padding-left: 0px; /* Ajustar el padding izquierdo */
    }
      .select2-container .select2-dropdown {
        z-index: 9999;
      }
      .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable  {
        background-color: #9C0C27 !important; /* Cambia este color al que desees */
        color: rgb(248, 243, 243) !important;/* Cambia el color del texto si es necesario */
    }
  </style>
