<form action="{{ route('usuario.store') }}" method="POST">
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
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombreUsuario" class="input-auth" required placeholder="Ingrese Nombre"/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidoUsuario" class="input-auth" required placeholder="Ingrese Apellidos"/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="categoriaUsuario">Categoría</label>
                <select name="categoriaUsuario" id="categoriaUsuario" class="form-select form-select-sm input-auth" required>
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
              <div class="col-13 form-outline mb-4">
                <label class="form-label">Profesión</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addProfesion()"><i class="fas fa-plus"></i></button>
                <div id="profesiones-container">
                  <div class="d-flex align-items-center mb-2">
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
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Especialidad</label>
                  <button type="button" class="btn btn-success btn-sm mb-2" onclick="addEspecialidad()"><i class="fas fa-plus"></i></button>
                  <div id="especialidades-container">
                    <div class="d-flex align-items-center">
                  <input type="text" name="especialidadUsuario[]" class="input-auth" required placeholder="Ingrese Especialidad" oninput="this.value = this.value.toUpperCase();"/>
                  <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                </div>
                </div>
              </div>
              
              <!-- <div class="form-outline mb-4">
                <label class="form-label">Especialidad</label>
                <button type="button" class="btn btn-success btn-sm mb-2" onclick="addEspecialidad()"><i class="fas fa-plus"></i></button>
                <div id="especialidades-container">
                  <div class="input-group mb-2">
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
                  </div>
                </div>
              </div> -->
              <div class="form-check pb-3">
                <input class="form-check-input" type="checkbox" id="activarCrearCuenta">
                <label class="form-check-label" for="flexCheckDefault">Crear cuenta en el sistema</label>
              </div>
              <div id="crearCuenta" class="card">
                <div class="card-body">
                  <div class="form-outline mb-4">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="email" class="input-auth"/>
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
              <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
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
    $('#ModalCreate').on('shown.bs.modal', function () {
      $('select[name="profesionUsuario[]"]').select2({
        placeholder: "Selecciona una profesión",
        allowClear: true,
        width: '100%',
        language: {
          noResults: function() {
            return "No se encontró el usuario";
          }
        }
      });
    });

    // Destruye Select2 cuando el modal se cierra para evitar problemas
    $('#ModalCreate').on('hidden.bs.modal', function () {
      $('select[name="profesionUsuario[]"]').select2('destroy');
    });
  });

  function addProfesion() {
    const container = document.getElementById('profesiones-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
    <div class="d-flex align-items-center mb-2">
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
      <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
      </div>
    `;
    container.appendChild(div);

    // Inicializa Select2 en el nuevo select
    $(div).find('select').select2({
      placeholder: "Selecciona una profesión",
      allowClear: true,
      width: '100%',
      language: {
        noResults: function() {
          return "No se encontró el usuario";
        }
      }
    });
  }
  function addEspecialidad() {
    const container = document.getElementById('especialidades-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
                <div class="d-flex align-items-center">
                  <input type="text" name="especialidadUsuario[]" class="input-auth" required placeholder="Ingrese Especialidad" oninput="this.value = this.value.toUpperCase();"/>
                  <button type="button" class="btn btn-danger btn-sm btn-adjust" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
                </div>
     `;
    container.appendChild(div);
  }
  /*function addEspecialidad() {
    const container = document.getElementById('especialidades-container');
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
</script>
<script>
  // Seleccionar el checkbox y el div
  const activarCrearCuenta = document.getElementById('activarCrearCuenta');
  const crearCuenta = document.getElementById('crearCuenta');

  // Añadir un listener para el evento 'change'
  activarCrearCuenta.addEventListener('change', function() {
    if (this.checked) {
      crearCuenta.style.display = 'block';
    } else {
      crearCuenta.style.display = 'none';
    }
  });
</script>
<style>
  /* Ajustar el z-index de Select2 */
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
<style>
  body {
    background-color: #000;
  }
  select {
    font-weight: normal;
    }
  select option.bold {
    font-weight: bold;
  }
  section {
    margin-top: 100px;
  }
  #crearCuenta {
    display: none;
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
  .form-check-input:checked {
    background-color: #9C0C27;
    border-color: #9C0C27;
  }
  .form-check-input:focus {
    box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
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