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
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombreUsuario" value="{{ $usuario->nombreUsuario }}" class="input-auth" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidoUsuario" value="{{ $usuario->apellidoUsuario }}" class="input-auth" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="categoriaUsuario">Categoría</label>
                <select name="categoriaUsuario" id="categoriaUsuario" class="form-select form-select-sm input-auth" required>
                  <option value="" disabled selected>Selecciona una categoría</option>
                  <option value="" disabled class="bold"><b>PROYECTISTA</b></option>
                  <option value="DA-I" {{ $usuario->categoriaUsuario == 'DA-I' ? 'selected' : '' }}>DA-I</option>
                  <option value="DA" {{ $usuario->categoriaUsuario == 'DA' ? 'selected' : '' }}>DA</option>
                  <option value="PA" {{ $usuario->categoriaUsuario == 'PA' ? 'selected' : '' }}>PA</option>
                  <option value="PB" {{ $usuario->categoriaUsuario == 'PB' ? 'selected' : '' }}>PB</option>
                  <option value="PC" {{ $usuario->categoriaUsuario == 'PC' ? 'selected' : '' }}>PC</option>
                  <option value="" disabled class="bold"><b>ASISTENTE</b></option>
                  <option value="PD" {{ $usuario->categoriaUsuario == 'PD' ? 'selected' : '' }}>PD</option>
                  <option value="PE" {{ $usuario->categoriaUsuario == 'PE' ? 'selected' : '' }}>PE</option>
                  <option value="TA" {{ $usuario->categoriaUsuario == 'TA' ? 'selected' : '' }}>TA</option>
                  <option value="TB" {{ $usuario->categoriaUsuario == 'TB' ? 'selected' : '' }}>TB</option>
                  <option value="AA" {{ $usuario->categoriaUsuario == 'AA' ? 'selected' : '' }}>AA</option>
                </select>
              </div>
              <div class="col-13 form-outline mb-4">
                <label class="form-label">Profesión</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addProfesionEdit({{$usuario->idUsuario}})"><i class="fas fa-plus"></i></button>
                <div id="profesiones-container-edit-{{$usuario->idUsuario}}">
                  @foreach ($usuario->profesiones as $profesion)
                    <div class="d-flex mb-2">
                      <select name="profesionUsuario[]" class="form-select form-select-sm input-auth" required>
                        <option value="" disabled>Selecciona una profesión</option>
                        <option value="INGENIERÍA QUIMICA" {{ $profesion->nombreProfesion == 'INGENIERÍA QUIMICA' ? 'selected' : '' }}>INGENIERÍA QUIMICA</option>
                        <option value="INGENIERÍA SONIDO"  {{ $profesion->nombreProfesion == 'INGENIERÍA SONIDO' ? 'selected' : '' }}>INGENIERÍA SONIDO</option>
                        <option value="INGENIERÍA CIVIL" {{ $profesion->nombreProfesion == 'INGENIERÍA CIVIL' ? 'selected' : '' }}>INGENIERÍA CIVIL</option>
                        <option value="INGENIERÍA MECATRÓNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA MECATRÓNICA' ? 'selected' : '' }}>INGENIERÍA MECATRÓNICA</option>
                        <option value="INGENIERÍA MECÁNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA MECÁNICA' ? 'selected' : '' }}>INGENIERÍA MECÁNICA</option>
                        <option value="INGENIERÍA SOFTWARE" {{ $profesion->nombreProfesion == 'INGENIERÍA SOFTWARE' ? 'selected' : '' }}>INGENIERÍA SOFTWARE</option>
                        <option value="INGENIERÍA HADWARE" {{ $profesion->nombreProfesion == 'INGENIERÍA HADWARE' ? 'selected' : '' }}>INGENIERÍA HADWARE</option>
                        <option value="INGENIERÍA INDUSTRIAL {{ $profesion->nombreProfesion == 'INGENIERÍA INDUSTRIAL' ? 'selected' : '' }}">INGENIERÍA INDUSTRIAL</option>
                        <option value="INGENIERÍA ELECTRÓNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELECTRÓNICA' ? 'selected' : '' }}>INGENIERÍA ELECTRÓNICA</option>
                        <option value="INGENIERÍA SANITARIA" {{ $profesion->nombreProfesion == 'INGENIERÍA SANITARIA' ? 'selected' : '' }}>INGENIERÍA SANITARIA</option>
                        <option value="INGENIERÍA ELÉCTRICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELÉCTRICA' ? 'selected' : '' }}>INGENIERÍA ELÉCTRICA</option>
                        <option value="INGENIERÍA AMBIENTAL" {{ $profesion->nombreProfesion == 'INGENIERÍA AMBIENTAL' ? 'selected' : '' }}>INGENIERÍA AMBIENTAL</option>
                        <option value="INGENIERÍA DE SISTEMAS" {{ $profesion->nombreProfesion == 'INGENIERÍA DE SISTEMAS' ? 'selected' : '' }}>INGENIERÍA DE SISTEMAS</option>
                        <option value="INGENIERÍA ELECTROMECÁNICA" {{ $profesion->nombreProfesion == 'INGENIERÍA ELECTROMECÁNICA' ? 'selected' : '' }}>INGENIERÍA ELECTROMECÁNICA</option>
                        <option value="INGENIERÍA GEOLÓGICA" {{ $profesion->nombreProfesion == 'INGENIERÍA GEOLÓGICA' ? 'selected' : '' }}>INGENIERÍA GEOLÓGICA</option>
                        <option value="INGENIERÍA DE MECÁNICA DE FLUIDOS" {{ $profesion->nombreProfesion == 'INGENIERÍA DE MECÁNICA DE FLUIDOS' ? 'selected' : '' }}>INGENIERÍA DE MECÁNICA DE FLUIDOS</option>
                        <option value="ANTROPOLOGÍA" {{ $profesion->nombreProfesion == 'ANTROPOLOGÍA' ? 'selected' : '' }}>ANTROPOLOGÍA</option>
                        <option value="BIOLOGÍA" {{ $profesion->nombreProfesion == 'BIOLOGÍA' ? 'selected' : '' }}>BIOLOGÍA</option>
                        <option value="ARQUITECTURA" {{ $profesion->nombreProfesion == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                        <option value="ARQUEÓLOGO" {{ $profesion->nombreProfesion == 'ARQUEÓLOGO' ? 'selected' : '' }}>ARQUEÓLOGO</option>
                        <option value="ABOGADO-DERECHO" {{ $profesion->nombreProfesion == 'ABOGADO-DERECHO' ? 'selected' : '' }}>ABOGADO-DERECHO</option>
                        <option value="ECONOMISTA-ECONOMÍA" {{ $profesion->nombreProfesion == 'ECONOMISTA-ECONOMÍA' ? 'selected' : '' }}>ECONOMISTA-ECONOMÍA</option>
                        <option value="CONTALIBIDAD" {{ $profesion->nombreProfesion == 'CONTALIBIDAD' ? 'selected' : '' }}>CONTALIBIDAD</option>
                        <option value="AGRONOMÍA" {{ $profesion->nombreProfesion == 'AGRONOMÍA' ? 'selected' : '' }}>AGRONOMÍA</option>
                        <option value="TURISMO Y HOTELERIA" {{ $profesion->nombreProfesion == 'TURISMO Y HOTELERIA' ? 'selected' : '' }}>TURISMO Y HOTELERIA</option>
                        <option value="ADMINISTRACIÓN" {{ $profesion->nombreProfesion == 'ADMINISTRACIÓN' ? 'selected' : '' }}>ADMINISTRACIÓN</option>
                        <option value="EDUCACIÓN" {{ $profesion->nombreProfesion == 'EDUCACIÓN' ? 'selected' : '' }}>EDUCACIÓN</option>
                        <option value="ADMINISTRACIÓN DE EMPRESAS" {{ $profesion->nombreProfesion == 'ADMINISTRACIÓN DE EMPRESAS' ? 'selected' : '' }}>ADMINISTRACIÓN DE EMPRESAS</option>
                        <option value="MARKETING" {{ $profesion->nombreProfesion == 'MARKETING' ? 'selected' : '' }}>MARKETING</option>
                        <option value="CIENCIA DE LA COMUNICACIÓN" {{ $profesion->nombreProfesion == 'CIENCIA DE LA COMUNICACIÓN' ? 'selected' : '' }}>CIENCIA DE LA COMUNICACIÓN</option>
                        <option value="PSICOLOGIA" {{ $profesion->nombreProfesion == 'PSICOLOGIA' ? 'selected' : '' }}>PSICOLOGIA</option>
                        <option value="QUIMICA Y BIOQUIMICA" {{ $profesion->nombreProfesion == 'QUIMICA Y BIOQUIMICA' ? 'selected' : '' }}>QUIMICA Y BIOQUIMICA</option>
                        <option value="SECRETARIA" {{ $profesion->nombreProfesion == 'SECRETARIA' ? 'selected' : '' }}>SECRETARIA</option>
                      </select>
                      <button type="button" class="btn btn-danger style-button" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Especialidad</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addEspecialidadEdit({{$usuario->idUsuario}})"><i class="fas fa-plus"></i></button>
                <div id="especialidades-container-edit-{{$usuario->idUsuario}}">
                  @foreach ($usuario->especialidades as $especialidad)
                    <div class="d-flex mb-2">
                      <input type="text" name="especialidadUsuario[]" value="{{ $especialidad->nombreEspecialidad }}" class="input-auth" required oninput="this.value = this.value.toUpperCase();"/>
                      <button type="button" class="btn btn-danger style-button" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>
              <!-- <div class="form-outline mb-4">
                <label class="form-label">Especialidad</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addEspecialidadEdit({{$usuario->idUsuario}})"><i class="fas fa-plus"></i></button>
                <div id="especialidades-container-edit-{{$usuario->idUsuario}}">
                  @foreach ($usuario->especialidades as $especialidad)
                    <div class="input-group mb-2">
                      <select name="especialidadUsuario[]" class="form-select form-select-sm input-auth" required>
                        <option value="" disabled>Selecciona una especialidad</option>
                        <option value="ARQUITECTURA" {{ $especialidad->nombreEspecialidad == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                        <option value="CAPACITACIÓN" {{ $especialidad->nombreEspecialidad == 'CAPACITACIÓN' ? 'selected' : '' }}>CAPACITACIÓN</option>
                        <option value="ARQUEOLOGÍA" {{ $especialidad->nombreEspecialidad == 'ARQUEOLOGÍA' ? 'selected' : '' }}>ARQUEOLOGÍA</option>
                        <option value="COMUNICACIONES TIC" {{ $especialidad->nombreEspecialidad == 'COMUNICACIONES TIC' ? 'selected' : '' }}>COMUNICACIONES TIC</option>
                        <option value="ESTRUCTURAS" {{ $especialidad->nombreEspecialidad == 'ESTRUCTURAS' ? 'selected' : '' }}>ESTRUCTURAS</option>
                        <option value="ESTUDIOS ECONÓMICOS" {{ $especialidad->nombreEspecialidad == 'ESTUDIOS ECONÓMICOS' ? 'selected' : '' }}>ESTUDIOS ECONÓMICOS</option>
                        <option value="GESTIÓN DE RIESGOS" {{ $especialidad->nombreEspecialidad == 'GESTIÓN DE RIESGO' ? 'selected' : '' }}>GESTIÓN DE RIESGO</option>
                        <option value="IMPACTO AMBIENTAL" {{ $especialidad->nombreEspecialidad == 'IMPACTO AMBIENTAL' ? 'selected' : '' }}>IMPACTO AMBIENTAL</option>
                        <option value="INSTALACIONES ELÉCTRICAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES ELÉCTRICAS' ? 'selected' : '' }}>INSTALACIONES ELÉCTRICAS</option>
                        <option value="INSTALACIONES MECÁNICAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES MECÁNICAS' ? 'selected' : '' }}>INSTALACIONES MECÁNICAS</option>
                        <option value="INSTALACIONES SANITARIAS" {{ $especialidad->nombreEspecialidad == 'INSTALACIONES SANITARIAS' ? 'selected' : '' }}>INSTALACIONES SANITARIAS</option>
                        <option value="PRESUPUESTO" {{ $especialidad->nombreEspecialidad == 'PRESUPUESTO' ? 'selected' : '' }}>PRESUPUESTO</option>
                        <option value="EVALUACIÓN DE RIESGOS" {{ $especialidad->nombreEspecialidad == 'EVALUACIÓN DE RIESGOS' ? 'selected' : '' }}>EVALUACIÓN DE RIESGOS </option>
                        <option value="EQUIPAMIENTO" {{ $especialidad->nombreEspecialidad == 'EQUIPAMIENTO' ? 'selected' : '' }}>EQUIPAMIENTO</option>
                        <option value="TRANSPORTES" {{ $especialidad->nombreEspecialidad == 'TRANSPORTES' ? 'selected' : '' }}>TRANSPORTES</option>
                        <option value="HIDRÁULICA" {{ $especialidad->nombreEspecialidad == 'HIDRÁULICA' ? 'selected' : '' }}>HIDRÁULICA</option>
                        <option value="SANEAMIENTO FÍSICO LEGAL" {{ $especialidad->nombreEspecialidad == 'SANEAMIENTO FÍSICO LEGAL' ? 'selected' : '' }}>SANEAMIENTO FÍSICO LEGAL</option>
                        <option value="MODELADOR BIM" {{ $especialidad->nombreEspecialidad == 'MODELADOR BIM' ? 'selected' : '' }}>MODELADOR BIM</option>
                        <option value="CORDINADOR BIM" {{ $especialidad->nombreEspecialidad == 'CORDINADOR BIM' ? 'selected' : '' }}>CORDINADOR BIM</option>
                        <option value="CORDINADOR BIM" {{ $especialidad->nombreEspecialidad == 'CORDINADOR BIM' ? 'selected' : '' }}>CORDINADOR BIM</option>
                        <option value="ECONOMISTA" {{ $especialidad->nombreEspecialidad == 'ECONOMISTA' ? 'selected' : '' }}>ECONOMISTA</option>
                        <option value="PROMOTOR SOCIAL" {{ $especialidad->nombreEspecialidad == 'PROMOTOR SOCIAL' ? 'selected' : '' }}>PROMOTOR SOCIAL</option>
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                </div>
              </div>-->
              <div class="form-check pb-3">
                <input class="form-check-input" type="checkbox" id="activarEditarCuenta{{$usuario->idUsuario}}" @if ($usuario->email) checked @endif>
                <label class="form-check-label" for="activarEditarCuenta{{$usuario->idUsuario}}">Crear cuenta en el sistema</label>
              </div>
              <div id="editarCuenta{{$usuario->idUsuario}}" class="card" style="@if ($usuario->email) display: block; @endif">
                <div class="card-body">
                  <div class="form-outline mb-4">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="email" value="{{ str_replace('@gorec.com', '', $usuario->email) }}" class="input-auth"/>
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="input-auth"/>
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
  $(document).ready(function() {
    $('#ModalEdit{{$usuario->idUsuario}}').on('shown.bs.modal', function () {
      $('select[name="profesionUsuario[]"]').select2({
        placeholder: "Selecciona una profesión",
        allowClear: true,
        width: '100%',
        language: {
          noResults: function() {
            return "No se encontró la profesión";
          }
        },
        dropdownParent: $('#ModalEdit{{$usuario->idUsuario}}')
      });
    });

    // Destruye Select2 cuando el modal se cierra para evitar problemas
    $('#ModalEdit{{$usuario->idUsuario}}').on('hidden.bs.modal', function () {
      $('select[name="profesionUsuario[]"]').select2('destroy');
    });
  });
  function addProfesionEdit(usuarioId) {
    const container = document.getElementById('profesiones-container-edit-' + usuarioId);
    const div = document.createElement('div');
    div.className = 'd-flex mb-2';
    div.innerHTML = `
      <select name="profesionUsuario[]" class="form-select form-select-sm input-auth" required>
        <option value="" disabled selected>Selecciona una profesión</option>
         <option value="INGENIERÍA QUIMICA">INGENIERÍA QUIMICA</option>
        <option value="INGENIERÍA SONIDO">INGENIERÍA SONIDO</option>
        <option value="INGENIERÍA CIVIL">INGENIERÍA CIVIL</option>
        <option value="INGENIERÍA MECATRÓNICA">INGENIERÍA MECATRÓNICA</option>
        <option value="INGENIERÍA MECÁNICA">INGENIERÍA MECÁNICA</option>
        <option value="INGENIERÍA SOFTWARE">INGENIERÍA SOFTWARE</option>
        <option value="INGENIERÍA HADWARE">INGENIERÍA HADWARE</option>
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
      <button type="button" class="btn btn-danger style-button" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);

    // Inicializa Select2 en el nuevo select
    $(div).find('select').select2({
      placeholder: "Selecciona una profesión",
      allowClear: true,
      width: '100%',
      language: {
        noResults: function() {
          return "No se encontró la profesión";
        }
      },
      dropdownParent: $('#ModalEdit' + usuarioId) 
    });
  }
  function addEspecialidadEdit(usuarioId) {
    const container = document.getElementById('especialidades-container-edit-' + usuarioId);
    const div = document.createElement('div');
    div.className = 'd-flex mb-2';
    div.innerHTML = `
      <input type="text" name="especialidadUsuario[]" class="input-auth" required placeholder="Ingrese Especialidad" oninput="this.value = this.value.toUpperCase();"/>
      <button type="button" class="btn btn-danger style-button" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);
  }
  /*function addEspecialidadEdit(usuarioId) {
    const container = document.getElementById('especialidades-container-edit-' + usuarioId);
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
      <select name="especialidadUsuario[]" class="form-select form-select-sm input-auth" required>
        <option value="" disabled selected>Selecciona una especialidad</option>
        <option value="ARQUITECTURA">ARQUITECTURA</option>
        <option value="CAPACITACIÓN">CAPACITACIÓN</option>
        <option value="ARQUEOLOGÍA">ARQUEOLOGÍA</option>
        <option value="COMUNICACIONES TIC">COMUNICACIONES TIC</option>
        <option value="ESTRUCTURAS">ESTRUCTURAS</option>
        <option value="ESTUDIOS ECONÓMICOS">ESTUDIOS ECONÓMICOS</option>
        <option value="GESTIÓN DE RIESGOS">GESTIÓN DE RIESGO</option>
        <option value="IMPACTO AMBIENTAL">IMPACTO AMBIENTAL</option>
        <option value="INSTALACIONES ELÉCTRICAS">INSTALACIONES ELÉCTRICAS</option>
        <option value="INSTALACIONES MECÁNICAS">INSTALACIONES MECÁNICAS</option>
        <option value="INSTALACIONES SANITARIAS">INSTALACIONES SANITARIAS</option>
        <option value="PRESUPUESTO">PRESUPUESTO</option>
        <option value="EVALUACIÓN DE RIESGOS">EVALUACIÓN DE RIESGOS </option>
        <option value="EQUIPAMIENTO">EQUIPAMIENTO</option>
        <option value="TRANSPORTES">TRANSPORTES</option>
        <option value="HIDRÁULICA">HIDRÁULICA</option>
        <option value="SANEAMIENTO FÍSICO LEGAL">SANEAMIENTO FÍSICO LEGAL</option>
        <option value="MODELADOR BIM">MODELADOR BIM</option>
        <option value="CORDINADOR BIM">CORDINADOR BIM</option>
        <option value="ECONOMISTA">ECONOMISTA</option>
        <option value="PROMOTOR SOCIAL">PROMOTOR SOCIAL</option>
      </select>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
    `;
    container.appendChild(div);
  }*/

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
  .style-button {
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
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