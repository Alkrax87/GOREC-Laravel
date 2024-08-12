<form action="{{ route('inversion.update', $inversion->idInversion) }}" method="POST">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalEdit{{$inversion->idInversion}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-clipboard-list"></i> Editar Inversion</h4>
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
              <p></p><b>Nombre: </b> {{ $inversion->nombreCortoInversion }}
            </div>
            <hr>
            <div class="col-12 form-outline mb-4">
              <label class="form-label" for="estadoInversion">Estado</label>
              <select name="estadoInversion" id="estadoInversion" class="form-select form-select-sm input-auth" required>
                <option value="" disabled selected>Selecciona una estado</option>
                <option value="POR ELABORAR" {{ $inversion->estadoInversion == 'POR ELABORAR' ? 'selected' : '' }}>POR ELABORAR</option>
                <option value="PARALIZADO" {{ $inversion->estadoInversion == 'PARALIZADO' ? 'selected' : '' }}>PARALIZADO</option>
                <option value="EN ELABORACIÓN" {{ $inversion->estadoInversion == 'EN ELABORACIÓN' ? 'selected' : '' }}>EN ELABORACIÓN</option>
                <option value="EN GRSLI" {{ $inversion->estadoInversion == 'EN GRSLI' ? 'selected' : '' }}>EN GRSLI</option>
                <option value="EN LEVANTAMIENTO DE OBSERVACIONES" {{ $inversion->estadoInversion == 'EN LEVANTAMIENTO DE OBSERVACIONES' ? 'selected' : '' }}>EN LEVANTAMIENTO DE OBSERVACIONES</option>
                <option value="CON CONFORMIDAD DE GRSLI" {{ $inversion->estadoInversion == 'CON CONFORMIDAD DE GRSLI' ? 'selected' : '' }}>CON CONFORMIDAD DE GRSLI</option>
                <option value="CON REGISTRO DE FASE DE EJECUCIÓN" {{ $inversion->estadoInversion == 'CON REGISTRO DE FASE DE EJECUCIÓN' ? 'selected' : '' }}>CON REGISTRO DE FASE DE EJECUCIÓN</option>
                <option value="CON RESOLUCIÓN EJECUTIVA" {{ $inversion->estadoInversion == 'CON RESOLUCIÓN EJECUTIVA' ? 'selected' : '' }}>CON RESOLUCIÓN EJECUTIVA</option>
              </select>
            </div>
            <div class="col-12">
              <h6 class="text-center">Aprobación de Consistencia</h6>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioConsistenciaInversion" value="{{ $inversion->fechaInicioConsistenciaInversion }}" class="input-auth"/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalConsistenciaInversion" value="{{ $inversion->fechaFinalConsistenciaInversion }}" class="input-auth"/>
                </div>
              </div>
            </div>
            <hr>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const inversionId = {{$inversion->idInversion}};
      const provinciaSelect = document.getElementById('provinciaInversionEdit' + inversionId);
      const distritoSelect = document.getElementById('distritoInversionEdit' + inversionId);

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
</form>


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