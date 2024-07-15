<form action="{{ route('inversion.store') }}" method="POST">
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
            <div class="row">
              <div class="col-12">
                <div class="form-outline mb-4">
                  <label class="form-label">CUI</label>
                  <input type="text" name="cuiInversion" class="input-auth" placeholder="CUI" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre</label>
                  <textarea class="form-control input-auth" name="nombreInversion" placeholder="Nombre Inversión" rows="4" required></textarea>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label">Nombre Corto</label>
                  <input type="text" name="nombreCortoInversion" class="input-auth" placeholder="Nombre Corto" required/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="idUsuario">Jefe</label>
                  <select name="idUsuario" id="idUsuario" class="form-select form-select-sm input-auth" required>
                    <option value="" disabled selected>Selecciona un usuario</option>
                    @foreach ($usuarios as $usuario)
                      <option value="{{ $usuario->idUsuario }}">
                        {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="provinciaInversion">Provincia</label>
                    <select name="provinciaInversion" id="provinciaInversion" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona una provincia</option>
                      @foreach ($provincias as $provincia)
                        <option value="{{ $provincia['nombre'] }}" data-distritos="{{ json_encode($provincia['distritos']) }}">
                          {{ $provincia['nombre'] }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="distritoInversion">Distrito</label>
                    <select name="distritoInversion" id="distritoInversion" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona un distrito</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4 form-outline mb-4">
                    <label class="form-label">Nivel</label>
                    <select name="nivelInversion" id="nivelInversion" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona un nivel</option>
                      <option value="EXPEDIENTE TÉCNICO">EXPEDIENTE TÉCNICO</option>
                      <option value="IOARR">IOARR</option>
                    </select>
                  </div>
                  <div class="col-8 form-outline mb-4">
                    <label class="form-label">Función</label>
                    <select name="funcionInversion" id="funcionInversion" class="form-select form-select-sm input-auth" required>
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
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="modalidadInversion">Modalidad</label>
                    <select name="modalidadInversion" id="modalidadInversion" class="form-select form-select-sm input-auth" required>
                      <option value="" disabled selected>Selecciona una modalidad</option>
                      <option value="DIRECTA">DIRECTA</option>
                      <option value="CONTRATA">CONTRATA</option>
                    </select>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label" for="estadoInversion">Estado</label>
                    <select name="estadoInversion" id="estadoInversion" class="form-select form-select-sm input-auth" required>
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
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fechaInicioInversion" class="input-auth" required/>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Fecha Final</label>
                    <input type="date" name="fechaFinalInversion" class="input-auth" required/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Presupuesto Formulación</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">S/</span>
                      <input type="text" name="presupuestoFormulacionInversion" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Formulación" required>
                    </div>
                  </div>
                  <div class="col-6 form-outline mb-4">
                    <label class="form-label">Presupuesto Ejecución</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">S/</span>
                      <input type="text" name="presupuestoEjecucionInversion" class="input-auth form-control" aria-label="Amount (to the nearest dollar)" placeholder="Presupuesto Ejecución" required>
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
  <script>
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
</form>
