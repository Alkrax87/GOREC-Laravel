<form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalCreate">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-users"></i> Crear Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <strong>Error!</strong> Por favor corrige los errores en el formulario.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <!-- Inputs -->
          <div class="mb-3">
            <label>Nombre(s)</label>
            <input type="text" name="nombreUsuario" class="form-control" placeholder="Ingrese Nombre(s)" required/>
          </div>
          <div class="mb-3">
            <label>Apellidos</label>
            <input type="text" name="apellidoUsuario" class="form-control" placeholder="Ingrese Apellidos" required/>
          </div>
          <div class="mb-3">
            <label>Categoría</label>
            <select name="categoriaUsuario" class="form-select" required>
              <option value="" disabled selected>Selecciona una categoría</option>
              <option value="" disabled class="bold"><b>PROYECTISTA</b></option>
              <option value="DA-I">DA-I</option>
              <option value="DA">DA</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PC">PC</option>
              <option value="" disabled class="bold"><b>ASISTENTE</b></option>
              <option value="PD">PD</option>
              <option value="PE">PE</option>
              <option value="TA">TA</option>
              <option value="TB">TB</option>
              <option value="AA">AA</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Profesión</label>
            <button type="button" class="btn btn-success btn-sm" onclick="addProfesion()">
              <i class="fas fa-plus"></i>
            </button>
            <div id="profesionesContainer">
              <div class="input-group mb-1">
                <select name="profesionUsuario[]" id="profesionesSelect" class="form-select" required>
                  <option value="" disabled selected>Selecciona una Profesión</option>
                  <option value="INGENIERÍA QUÍMICA">INGENIERÍA QUÍMICA</option>
                  <option value="INGENIERÍA SONIDO">INGENIERÍA SONIDO</option>
                  <option value="INGENIERÍA CIVIL">INGENIERÍA CIVIL</option>
                  <option value="INGENIERÍA MECATRÓNICA">INGENIERÍA MECATRÓNICA</option>
                  <option value="INGENIERÍA MECÁNICA">INGENIERÍA MECÁNICA</option>
                  <option value="INGENIERÍA SOFTWARE">INGENIERÍA SOFTWARE</option>
                  <option value="INGENIERÍA HARDWARE">INGENIERÍA HARDWARE</option>
                  <option value="INGENIERÍA INDUSTRIAL">INGENIERÍA INDUSTRIAL</option>
                  <option value="INGENIERÍA ELECTRÓNICA">INGENIERÍA ELECTRÓNICA</option>
                  <option value="INGENIERÍA SANITARIA">INGENIERÍA SANITARIA</option>
                  <option value="INGENIERÍA ELÉCTRICA">INGENIERÍA ELÉCTRICA</option>
                  <option value="INGENIERÍA AMBIENTAL">INGENIERÍA AMBIENTAL</option>
                  <option value="INGENIERÍA DE SISTEMAS">INGENIERÍA DE SISTEMAS</option>
                  <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
                  <option value="INGENIERÍA GEOLÓGICA">INGENIERÍA GEOLÓGICA</option>
                  <option value="INGENIERÍA DE MECÁNICA DE FLUIDOS">INGENIERÍA DE MECÁNICA DE FLUIDOS</option>
                  <option value="ANTROPOLOGÍA">ANTROPOLOGÍA</option>
                  <option value="BIOLOGÍA">BIOLOGÍA</option>
                  <option value="ARQUITECTURA">ARQUITECTURA</option>
                  <option value="ARQUEÓLOGO">ARQUEÓLOGO</option>
                  <option value="ABOGADO-DERECHO">ABOGADO-DERECHO</option>
                  <option value="ECONOMISTA-ECONOMÍA">ECONOMISTA-ECONOMÍA</option>
                  <option value="CONTALIBIDAD">CONTALIBIDAD</option>
                  <option value="AGRONOMÍA">AGRONOMÍA</option>
                  <option value="TURISMO Y HOTELERIA">TURISMO Y HOTELERIA</option>
                  <option value="ADMINISTRACIÓN">ADMINISTRACIÓN</option>
                  <option value="EDUCACIÓN">EDUCACIÓN</option>
                  <option value="ADMINISTRACIÓN DE EMPRESAS">ADMINISTRACIÓN DE EMPRESAS</option>
                  <option value="MARKETING">MARKETING</option>
                  <option value="CIENCIA DE LA COMUNICACIÓN">CIENCIA DE LA COMUNICACIÓN</option>
                  <option value="PSICOLOGIA">PSICOLOGIA</option>
                  <option value="QUIMICA Y BIOQUIMICA">QUIMICA Y BIOQUIMICA</option>
                  <option value="SECRETARIA">SECRETARIA</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm disabled">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label>Especialidad</label>
            <button type="button" class="btn btn-success btn-sm" onclick="addEspecialidad()">
              <i class="fas fa-plus"></i>
            </button>
            <div id="especialidadesContainer">
              <div class="input-group mb-1">
                <input type="text" name="especialidadUsuario[]" class="form-control" placeholder="Ingrese una Especialidad" oninput="this.value = this.value.toUpperCase()" required/>
                <button type="button" class="btn btn-danger btn-sm disabled">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="form-check pb-3">
            <input class="form-check-input" name="cuentaUsuario" type="checkbox" id="activarCrearCuenta">
            <label>Crear Cuenta</label>
          </div>
          <div class="card mb-3 d-none" id="crearCuenta">
            <div class="card-header bg-success text-white">Crear Cuenta</div>
            <div class="card-body">
              <div class="mb-3">
                <label>Usuario</label>
                <input type="text" name="email" class="form-control"/>
              </div>
              <div class="mb-1">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control"/>
              </div>
            </div>
          </div>
          <!-- Buttons -->
          <div class="pt-3 text-center">
            <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  // Profesión
  function addProfesion() {
    const container = document.getElementById('profesionesContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-1';
    const profesionesSelect = document.getElementById('profesionesSelect');
    const newSelect = profesionesSelect.cloneNode(true);
    newSelect.id = '';
    div.appendChild(newSelect);
    div.innerHTML += `
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">
        <i class="fas fa-trash-alt"></i>
      </button>
    `;
    container.appendChild(div);
  }
    
  // Especialidad
  function addEspecialidad() {
    const container = document.getElementById('especialidadesContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-1';
    div.innerHTML += `
      <input type="text" name="especialidadUsuario[]" class="form-control" placeholder="Ingrese Especialidad" oninput="this.value = this.value.toUpperCase()" required/>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">
        <i class="fas fa-trash-alt"></i>
      </button>
    `;
    container.appendChild(div);
  }

  function removeElement(element) {
    element.parentNode.remove();
  }

  // Activar crear cuenta
  const activarCrearCuenta = document.getElementById('activarCrearCuenta');
  const crearCuenta = document.getElementById('crearCuenta');
  activarCrearCuenta.addEventListener('change', function() {
    if (this.checked) {
      crearCuenta.classList.remove('d-none');
    } else {
      crearCuenta.classList.add('d-none');
    }
  });
</script>