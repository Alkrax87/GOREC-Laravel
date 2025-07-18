@extends('adminlte::page')

@section('title', 'Editar Especialidad')

@section('content_header')
  <h1><i class="fas fa-users-cog"></i> Editar "{{ $especialidad->nombreEspecialidad }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">

          <form action="{{ route('especialidad.update', $especialidad->idEspecialidad) }}" method="POST">
            @csrf
            <div class="col-12">
              <select name="idInversion" id="idInversion-{{ $especialidad->idEspecialidad }}"
                class="form-select" required hidden>
                <option value="" disabled>Selecciona una inversión</option>
                @foreach ($inversiones as $inversion)
                  <option value="{{ $inversion->idInversion }}"
                    {{ $especialidad->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                    {{ $inversion->nombreCortoInversion }}
                  </option>
                @endforeach
              </select>
              <div class="row">
                <div class="col-8 form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombreEspecialidad" value="{{ $especialidad->nombreEspecialidad }}"
                    class="form-control" required />
                </div>
                <div class="col-4 form-outline mb-4">
                  <label class="form-label">Avance Programado</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="porcentajeAvanceEspecialidad"
                      value="{{ $especialidad->porcentajeAvanceEspecialidad }}" required min="0" max="100"
                      step="0.01">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>

              <!-- Encargados -->
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Proyectistas</label>
                <button type="button" class="btn btn-success btn-sm mb-2"
                  onclick="addUsuarioEdit({{ $especialidad->idEspecialidad }})"><i class="fas fa-plus"></i></button>
                <div id="usuarios-container-edit-{{ $especialidad->idEspecialidad }}">
                  @foreach ($especialidad->usuarios as $usuario)
                    <div class="input-group mb-2">
                      <select name="idUsuario[]" class="form-select" required>
                        <option value="" disabled>Selecciona un usuario</option>
                        @foreach ($usuarios as $user)
                          <option value="{{ $user->idUsuario }}"
                            {{ $user->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                            {{ $user->nombreUsuario . ' ' . $user->apellidoUsuario }}
                          </option>
                        @endforeach
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">
                        <i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-12 py-2 text-center">
              <a href="{{ route('especialidad.index') }}" class="btn btn-primary mx-1">
                <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
              </a>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
        const usuariosContainer = document.getElementById('usuarios-container-edit-' +
          {{ $especialidad->idEspecialidad }});
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
        div.innerHTML +=
          `<button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>`;
        // Añade el div al contenedor
        container.appendChild(div);
      };

      // Definir la función en el ámbito global
window.removeElement = function(button) {
  const div = button.closest('.input-group'); // Encuentra el div más cercano con la clase .input-group
  if (div) {
    div.remove(); // Elimina el div completo
  }
};
    });
  </script>
@stop
