<form action="{{ route('segmento.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-stream"></i> Crear Segmento</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <b>Error!</b> Por favor corrige los errores en el formulario.<br><br>
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
                <label class="form-label">Nombre</label>
                <input type="text" name="nombreSegmento" class="input-auth" required/>
              </div>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioSegmento" class="input-auth" required/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalSegmento" class="input-auth" required/>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                <select name="idInversion" id="idInversion" class="form-select form-select-sm input-auth" required>
                  <option value="" disabled selected>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}">
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Usuario</label>
                <select name="idUsuario" id="idUsuario" class="form-select form-select-sm input-auth" required>
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
      $('#idInversion').select2({
        placeholder: "Selecciona una inversión",
        allowClear: true,
          language: {
            noResults: function() {
              return "No se encontró la inversión";
            }
          }
      });
      $('#idUsuario').select2({
        placeholder: "Selecciona un usuario",
        allowClear: true,
          language: {
            noResults: function() {
              return "No se encontró el usuario";
            }
          }
      });
    });

    // Destruye Select2 cuando el modal se cierra para evitar problemas
    $('#ModalCreate').on('hidden.bs.modal', function () {
      $('#idInversion').select2('destroy');
      $('#idUsuario').select2('destroy');
    });
  });
</script>
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