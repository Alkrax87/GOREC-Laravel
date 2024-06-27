<form action="{{ route('usuario.update', $usuario->idUsuario) }}" method="POST">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalEdit{{$usuario->idUsuario}}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-users"></i> Editar Usuario</h4>
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
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombreUsuario" value="{{ $usuario->nombreUsuario }}" class="input-auth" placeholder="Nombres" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidoUsuario" value="{{ $usuario->apellidoUsuario }}" class="input-auth" placeholder="Apellidos" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Profesión</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addProfesionEdit({{$usuario->idUsuario}})"><i class="fas fa-plus"></i></button>
                <div id="profesiones-container-edit-{{$usuario->idUsuario}}">
                  @foreach ($usuario->profesiones as $profesion)
                    <div class="input-group mb-2">
                      <select name="profesionUsuario[]" class="form-select form-select-sm input-auth" required>
                        <option value="" disabled>Selecciona una profesión</option>
                        <option value="INGENIERÍA CIVIL" {{ $profesion->nombreProfesion == 'INGENIERÍA CIVIL' ? 'selected' : '' }}>INGENIERÍA CIVIL</option>
                        <option value="INGENIERÍA MECÁNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA MECÁNICA' ? 'selected' : '' }}>INGENIERÍA MECÁNICA</option>
                        <option value="INGENIERÍA SANITARIA" {{ $profesion->nombreProfesion == 'INGENIERÍA SANITARIA' ? 'selected' : '' }}>INGENIERÍA SANITARIA</option>
                        <option value="INGENIERÍA ELÉCTRICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELÉCTRICA' ? 'selected' : '' }}>INGENIERÍA ELÉCTRICA</option>
                        <option value="INGENIERÍA AMBIENTAL" {{ $profesion->nombreProfesion == 'INGENIERÍA AMBIENTAL' ? 'selected' : '' }}>INGENIERÍA AMBIENTAL</option>
                        <option value="INGENIERÍA DE SISTEMAS" {{ $profesion->nombreProfesion == 'INGENIERÍA DE SISTEMAS' ? 'selected' : '' }}>INGENIERÍA DE SISTEMAS</option>
                        <option value="ARQUITECTO" {{ $profesion->nombreProfesion == 'ARQUITECTO' ? 'selected' : '' }}>ARQUITECTO</option>
                        <option value="ARQUEÓLOGO" {{ $profesion->nombreProfesion == 'ARQUEÓLOGO' ? 'selected' : '' }}>ARQUEÓLOGO</option>
                        <option value="ABOGADO" {{ $profesion->nombreProfesion == 'ABOGADO' ? 'selected' : '' }}>ABOGADO</option>
                        <option value="ECONOMISTA" {{ $profesion->nombreProfesion == 'ECONOMISTA' ? 'selected' : '' }}>ECONOMISTA</option>
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Especialidad</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addEspecialidadEdit({{$usuario->idUsuario}})"><i class="fas fa-plus"></i></button>
                <div id="especialidades-container-edit-{{$usuario->idUsuario}}">
                  @foreach ($usuario->especialidades as $especialidad)
                    <div class="input-group mb-2">
                      <select name="especialidadUsuario[]" class="form-select form-select-sm input-auth" required>
                        <option value="" disabled>Selecciona una especialidad</option>
                        <option value="ARQUITECTURA" {{ $especialidad->nombreEspecialidad == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                        <option value="CAPACITACIÓN" {{ $especialidad->nombreEspecialidad == 'CAPACITACIÓN' ? 'selected' : '' }}>CAPACITACIÓN</option>
                        <option value="ARQUEOLOGIA" {{ $especialidad->nombreEspecialidad == 'ARQUEOLOGIA' ? 'selected' : '' }}>ARQUEOLOGIA</option>
                        <option value="COMUNICACIONES" {{ $especialidad->nombreEspecialidad == 'COMUNICACIONES' ? 'selected' : '' }}>COMUNICACIONES</option>
                        <option value="ESTRUCTURAS" {{ $especialidad->nombreEspecialidad == 'ESTRUCTURAS' ? 'selected' : '' }}>ESTRUCTURAS</option>
                        <option value="ESTUDIOS ECONOMICOS" {{ $especialidad->nombreEspecialidad == 'ESTUDIOS ECONOMICOS' ? 'selected' : '' }}>ESTUDIOS ECONOMICOS</option>
                        <option value="GESTIÓN DE RIESGOS" {{ $especialidad->nombreEspecialidad == 'GESTIÓN DE RIESGO' ? 'selected' : '' }}>GESTIÓN DE RIESGO</option>
                        <option value="IMPACTO AMBIENTAL" {{ $especialidad->nombreEspecialidad == 'IMPACTO AMBIENTAL' ? 'selected' : '' }}>IMPACTO AMBIENTAL</option>
                        <option value="INSTALACIONES ELÉCTRICAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES ELÉCTRICAS' ? 'selected' : '' }}>INSTALACIONES ELÉCTRICAS</option>
                        <option value="INSTALACIONES MECÁNICAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES MECÁNICAS' ? 'selected' : '' }}>INSTALACIONES MECÁNICAS</option>
                        <option value="INSTALACIONES SANITARIAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES SANITARIAS' ? 'selected' : '' }}>INSTALACIONES SANITARIAS</option>
                        <option value="PRESUPUESTO" {{ $especialidad->nombreEspecialidad == 'PRESUPUESTO' ? 'selected' : '' }}>PRESUPUESTO</option>
                        <option value="EVALUACION DE RIESGOS" {{ $especialidad->nombreEspecialidad == 'EVALUACION DE RIESGOS' ? 'selected' : '' }}>EVALUACION DE RIESGOS </option>
                        <option value="EQUIPAMIENTO" {{ $especialidad->nombreEspecialidad == 'EQUIPAMIENTO' ? 'selected' : '' }}>EQUIPAMIENTO</option>
                        <option value="TRASPORTES" {{ $especialidad->nombreEspecialidad == 'TRASPORTES' ? 'selected' : '' }}>TRASPORTES</option>
                        <option value="SANEAMIENTO FÍSICO LEGAL" {{ $especialidad->nombreEspecialidad == 'SANEAMIENTO FÍSICO LEGAL' ? 'selected' : '' }}>SANEAMIENTO FÍSICO LEGAL</option>
                        <option value="MODELADOR BIN" {{ $especialidad->nombreEspecialidad == 'MODELADOR BIN' ? 'selected' : '' }}>MODELADOR BIN</option>
                        <option value="CORDINADOR BIN" {{ $especialidad->nombreEspecialidad == 'CORDINADOR BIN' ? 'selected' : '' }}>CORDINADOR BIN</option>
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="form-check pb-3">
                <input class="form-check-input" type="checkbox" id="activarEditarCuenta{{$usuario->idUsuario}}" @if ($usuario->email) checked @endif>
                <label class="form-check-label" for="activarEditarCuenta{{$usuario->idUsuario}}">Crear cuenta en el sistema</label>
              </div>
              <div id="editarCuenta{{$usuario->idUsuario}}" class="card" style="@if ($usuario->email) display: block; @endif">
                <div class="card-body">
                  <div class="form-outline mb-4">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="email" value="{{ str_replace('@gorec.com', '', $usuario->email) }}" class="input-auth" placeholder="Usuario"/>
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="input-auth" placeholder="********"/>
                  </div>
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
  // JavaScript para manejar la edición de profesiones y especialidades

  function addProfesionEdit(usuarioId) {
    const container = document.getElementById('profesiones-container-edit-' + usuarioId);
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
      <select name="profesionUsuario[]" class="form-select form-select-sm input-auth" required>
        <option value="" disabled selected>Selecciona una profesión</option>
        <option value="INGENIERÍA CIVIL">INGENIERÍA CIVIL</option>
        <option value="INGENIERÍA MECÁNICA">INGENIERÍA MECÁNICA</option>
        <option value="INGENIERÍA SANITARIA">INGENIERÍA SANITARIA</option>
        <option value="INGENIERÍA ELÉCTRICA">INGENIERÍA ELÉCTRICA</option>
        <option value="INGENIERÍA AMBIENTAL">INGENIERÍA AMBIENTAL</option>
        <option value="INGENIERÍA DE SISTEMAS">INGENIERÍA DE SISTEMAS</option>
        <option value="ARQUITECTO">ARQUITECTO</option>
        <option value="ARQUEÓLOGO">ARQUEÓLOGO</option>
        <option value="ABOGADO">ABOGADO</option>
        <option value="ECONOMISTA">ECONOMISTA</option>
      </select>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);
  }

  function addEspecialidadEdit(usuarioId) {
    const container = document.getElementById('especialidades-container-edit-' + usuarioId);
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
      <select name="especialidadUsuario[]" class="form-select form-select-sm input-auth" required>
        <option value="" disabled selected>Selecciona una especialidad</option>
        <option value="ARQUITECTURA">ARQUITECTURA</option>
        <option value="CAPACITACIÓN">CAPACITACIÓN</option>
        <option value="ARQUEOLOGIA">ARQUEOLOGIA</option>
        <option value="COMUNICACIONES">COMUNICACIONES</option>
        <option value="ESTRUCTURAS">ESTRUCTURAS</option>
        <option value="ESTUDIOS ECONOMICOS">ESTUDIOS ECONOMICOS</option>
        <option value="GESTIÓN DE RIESGOS">GESTIÓN DE RIESGO</option>
        <option value="IMPACTO AMBIENTAL">IMPACTO AMBIENTAL</option>
        <option value="INSTALACIONES ELÉCTRICAS">INSTALACIONES ELÉCTRICAS</option>
        <option value="INSTALACIONES MECÁNICAS">INSTALACIONES MECÁNICAS</option>
        <option value="INSTALACIONES SANITARIAS">INSTALACIONES SANITARIAS</option>
        <option value="PRESUPUESTO">PRESUPUESTO</option>
        <option value="EVALUACION DE RIESGOS">EVALUACION DE RIESGOS </option>
        <option value="EQUIPAMIENTO">EQUIPAMIENTO</option>
        <option value="TRASPORTES">TRASPORTES</option>
        <option value="SANEAMIENTO FÍSICO LEGAL">SANEAMIENTO FÍSICO LEGAL</option>
        <option value="MODELADOR BIN">MODELADOR BIN</option>
        <option value="CORDINADOR BIN">CORDINADOR BIN</option>
      </select>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);
  }

  function removeElement(element) {
    element.parentNode.remove();
  }

  // Obtener el checkbox y el div específicos para este usuario
  const activarEditarCuenta{{$usuario->idUsuario}} = document.getElementById('activarEditarCuenta{{$usuario->idUsuario}}');
  const editarCuenta{{$usuario->idUsuario}} = document.getElementById('editarCuenta{{$usuario->idUsuario}}');

  // Añadir un listener para el evento 'change'
  activarEditarCuenta{{$usuario->idUsuario}}.addEventListener('change', function() {
    if (this.checked) {
      editarCuenta{{$usuario->idUsuario}}.style.display = 'block';
    } else {
      editarCuenta{{$usuario->idUsuario}}.style.display = 'none';
    }
  });
</script>


<style>
  [id^="editarCuenta"] {
    display: none;
  }
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
  .form-check-input:checked {
    background-color: #9C0C27;
    border-color: #9C0C27;
  }
  .form-check-input:focus {
    box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
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