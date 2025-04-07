<form action="{{ route('inversion.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Crear Inversión</h4>
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
            <label>CUI</label>
            <input type="text" name="cuiInversion" class="form-control" placeholder="CUI" required/>
          </div>
          <div class="mb-3">
            <label>Nombre</label>
            <textarea name="nombreInversion" class="form-control" placeholder="Nombre Inversión" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label>Nombre Corto</label>
            <input type="text" name="nombreCortoInversion" class="form-control" placeholder="Nombre Corto" required/>
          </div>
          <div class="mb-3">
            <label>Responsable</label>
            <select name="idUsuario" class="form-select" required>
              <option value="" disabled selected>Selecciona un usuario</option>
              @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->idUsuario }}">
                  {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                  P: (
                    @if ($usuario->profesiones->isNotEmpty())
                      @foreach ($usuario->profesiones as $profesion)
                        {{ $profesion->nombreProfesion }}
                        @if (!$loop->last)
                          ,
                        @endif
                      @endforeach
                    @endif
                  )
                  &nbsp; | &nbsp;
                  E: (
                    @if ($usuario->especialidades->isNotEmpty())
                      @foreach ($usuario->especialidades as $especialidad)
                        {{ $especialidad->nombreEspecialidad }}
                        @if (!$loop->last)
                          ,
                        @endif
                      @endforeach
                    @endif
                  )
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Coordinadores</label>
            <button type="button" class="btn btn-success btn-sm" onclick="addMoreCoordinadores()">
              <i class="fas fa-plus"></i>
            </button>
            <div id="coordinadoresContainer">
              <div class="input-group mb-1">
                <select name="idCoordinador[]" id="usuariosSelect" class="form-select" required>
                  <option value="" disabled selected>Selecciona un usuario</option>
                  @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->idUsuario }}">
                      {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                      P: (
                        @if ($usuario->profesiones->isNotEmpty())
                          @foreach ($usuario->profesiones as $profesion)
                            {{ $profesion->nombreProfesion }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                      )
                      &nbsp; | &nbsp;
                      E: (
                        @if ($usuario->especialidades->isNotEmpty())
                          @foreach ($usuario->especialidades as $especialidad)
                            {{ $especialidad->nombreEspecialidad }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                      )
                    </option>
                  @endforeach
                </select>
                <button type="button" class="btn btn-danger btn-sm disabled">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Provincia</label>
              <select name="provinciaInversion" id="provinciaInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona una provincia</option>
                @foreach ($provincias as $provincia)
                  <option value="{{ $provincia['nombre'] }}" data-distritos="{{ json_encode($provincia['distritos']) }}">
                    {{ $provincia['nombre'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label>Distrito</label>
              <select name="distritoInversion" id="distritoInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona un distrito</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-4">
              <label>Nivel</label>
              <select name="nivelInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona un nivel</option>
                <option value="EXPEDIENTE TÉCNICO">EXPEDIENTE TÉCNICO</option>
                <option value="IOARR">IOARR</option>
              </select>
            </div>
            <div class="col-8">
              <label>Función</label>
              <select name="funcionInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona una función</option>
                <option value="PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA">PLANEAMIENTO, GESTIÓN Y RESERVA DE CONTINGENCIA</option>
                <option value="JUSTICIA">JUSTICIA</option>
                <option value="TRANSPORTE">TRANSPORTE</option>
                <option value="SANEAMIENTO">SANEAMIENTO</option>
                <option value="SALUD">SALUD</option>
                <option value="EDUCACIÓN">EDUCACIÓN</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-5">
              <label>Modalidad</label>
              <select name="modalidadInversion" class="form-select" required>
                <option value="" disabled selected>Selecciona una modalidad</option>
                <option value="DIRECTA">DIRECTA</option>
                <option value="CONTRATA">CONTRATA</option>
              </select>
            </div>
            <div class="col-7">
              <label>Estado</label>
              <select name="estadoInversion" class="form-select" required>
                <option value="" disabled>Selecciona una estado</option>
                <option value="POR ELABORAR" selected>POR ELABORAR</option>
                <option value="PARALIZADO">PARALIZADO</option>
                <option value="EN ELABORACIÓN">EN ELABORACIÓN</option>
                <option value="EN GRSLI">EN GRSLI</option>
                <option value="EN LEVANTAMIENTO DE OBSERVACIONES">EN LEVANTAMIENTO DE OBSERVACIONES</option>
                <option value="CON CONFORMIDAD DE GRSLI">CON CONFORMIDAD DE GRSLI</option>
                <option value="CON REGISTRO DE FASE DE EJECUCIÓN">CON REGISTRO DE FASE DE EJECUCIÓN</option>
                <option value="CON RESOLUCIÓN EJECUTIVA">CON RESOLUCIÓN EJECUTIVA</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Fecha Inicio</label>
              <input type="date" name="fechaInicioInversion" class="form-control" required/>
            </div>
            <div class="col-6">
              <label>Fecha Final</label>
              <input type="date" name="fechaFinalInversion" class="form-control" required/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label>Presupuesto Formulación</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary"><b>S/</b></span>
                <input type="text" name="presupuestoFormulacionInversion" class="form-control" placeholder="Presupuesto Formulación" required>
              </div>
            </div>
            <div class="col-6">
              <label>Presupuesto Ejecución</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary"><b>S/</b></span>
                <input type="text" name="presupuestoEjecucionInversion" class="form-control" placeholder="Presupuesto Ejecución" required>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Archivo</label>
            <input type="file" name="archivoInversion" id="archivoInversion" accept="application/pdf" class="form-control">
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

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Coordinadores
  function addMoreCoordinadores() {
    const container = document.getElementById('coordinadoresContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-1';
    const usuariosSelect = document.getElementById('usuariosSelect');
    const newSelect = usuariosSelect.cloneNode(true);
    newSelect.id = '';
    div.appendChild(newSelect);
    div.innerHTML += `
      <button type="button" class="btn btn-danger btn-sm" onclick="removeCoordinador(this)">
        <i class="fas fa-trash-alt"></i>
      </button>`;
    container.appendChild(div);
  }
  function removeCoordinador(element) {
    element.parentNode.remove();
  }

  // Selector ( Provincia - Distrito )
  document.addEventListener('DOMContentLoaded', function () {
    const provinciaSelect = document.getElementById('provinciaInversion');
    const distritoSelect = document.getElementById('distritoInversion');

    provinciaSelect.addEventListener('change', function () {
      const distritos = JSON.parse(this.selectedOptions[0].getAttribute('data-distritos'));
      distritoSelect.innerHTML = '<option value="" disabled selected>Selecciona un distrito</option>';
      distritos.forEach(distrito => {
        const option = document.createElement('option');
        option.value = distrito;
        option.textContent = distrito;
        distritoSelect.appendChild(option);
      });
    });
  });

  // Validación del archivo (tamaño máximo 1MB)
  document.getElementById('archivoInversion').addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.size > 1 * 1024 * 1024) {
      alert('El archivo es mayor a 1 MB. Por favor, selecciona un archivo más pequeño.');
      this.value = '';
    }
  });
</script>