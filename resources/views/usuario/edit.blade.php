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
                <label class="form-label">Usuario</label>
                <input type="text" name="email" value="{{ $usuario->email }}" class="input-auth" placeholder="Usuario" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="input-auth" placeholder="********"/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="profesionUsuario">Profesión</label>
                <select name="profesionUsuario" id="profesionUsuario" class="form-select form-select-sm input-auth" required>
                  <option value="" disabled>Selecciona una profesión</option>
                  <option value="INGENIERÍA CIVIL" {{ $usuario->profesionUsuario == 'INGENIERÍA CIVIL' ? 'selected' : '' }}>INGENIERÍA CIVIL</option>
                  <option value="INGENIERÍA MECÁNICA" {{ $usuario->profesionUsuario == 'INGENIERÍA MECÁNICA' ? 'selected' : '' }}>INGENIERÍA MECÁNICA</option>
                  <option value="INGENIERÍA SANITARIA" {{ $usuario->profesionUsuario == 'INGENIERÍA SANITARIA' ? 'selected' : '' }}>INGENIERÍA SANITARIA</option>
                  <option value="INGENIERÍA ELÉCTRICA" {{ $usuario->profesionUsuario == 'INGENIERÍA ELÉCTRICA' ? 'selected' : '' }}>INGENIERÍA ELÉCTRICA</option>
                  <option value="INGENIERÍA AMBIENTAL" {{ $usuario->profesionUsuario == 'INGENIERÍA AMBIENTAL' ? 'selected' : '' }}>INGENIERÍA AMBIENTAL</option>
                  <option value="INGENIERÍA DE SISTEMAS" {{ $usuario->profesionUsuario == 'INGENIERÍA DE SISTEMAS' ? 'selected' : '' }}>INGENIERÍA DE SISTEMAS</option>
                  <option value="ARQUITECTO" {{ $usuario->profesionUsuario == 'ARQUITECTO' ? 'selected' : '' }}>ARQUITECTO</option>
                  <option value="ARQUEÓLOGO" {{ $usuario->profesionUsuario == 'ARQUEÓLOGO' ? 'selected' : '' }}>ARQUEÓLOGO</option>
                  <option value="ABOGADO" {{ $usuario->profesionUsuario == 'ABOGADO' ? 'selected' : '' }}>ABOGADO</option>
                  <option value="ECONOMISTA" {{ $usuario->profesionUsuario == 'ECONOMISTA' ? 'selected' : '' }}>ECONOMISTA</option>
                </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="especialidadUsuario">Especialidad</label>
                <select name="especialidadUsuario" id="especialidadUsuario" class="form-select form-select-sm input-auth" required>
                  <option value="" disabled>Selecciona una especialidad</option>
                  <option value="ARQUITECTURA" {{ $usuario->especialidadUsuarios == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                  <option value="CAPACITACIÓN" {{ $usuario->especialidadUsuario == 'CAPACITACIÓN' ? 'selected' : '' }}>CAPACITACIÓN</option>
                  <option value="ARQUEOLOGIA" {{ $usuario->especialidadUsuario == 'ARQUEOLOGIA' ? 'selected' : '' }}>ARQUEOLOGIA</option>
                  <option value="COMUNICACIONES" {{ $usuario->especialidadUsuario == 'COMUNICACIONES' ? 'selected' : '' }}>COMUNICACIONES</option>
                  <option value="ESTRUCTURAS" {{ $usuario->especialidadUsuario== 'INGENIERÍA ESTRUCTURAS' ? 'selected' : '' }}>ESTRUCTURAS</option>
                  <option value="ESTUDIOS ECONOMICOS" {{ $usuario->especialidadUsuario == 'ESTUDIOS ECONOMICOS' ? 'selected' : '' }}>ESTUDIOS ECONOMICOS</option>
                  <option value="GESTIÓN DE RIESGOS" {{ $usuario->especialidadUsuario == 'GESTIÓN DE RIESGO' ? 'selected' : '' }}>GESTIÓN DE RIESGO</option>
                  <option value="IMPACTO AMBIENTAL" {{ $usuario->especialidadUsuario == 'IMPACTO AMBIENTAL' ? 'selected' : '' }}>IMPACTO AMBIENTAL</option>
                  <option value="INSTALACIONES ELÉCTRICAS" {{ $usuario->especialidadUsuario == 'INSTALACIONES ELÉCTRICAS' ? 'selected' : '' }}>INSTALACIONES ELÉCTRICAS</option>
                  <option value="INSTALACIONES MECÁNICAS" {{ $usuario->especialidadUsuario == 'INSTALACIONES MECÁNICAS' ? 'selected' : '' }}>INSTALACIONES MECÁNICAS</option>
                  <option value="INSTALACIONES SANITARIAS" {{ $usuario->especialidadUsuario == 'INSTALACIONES SANITARIAS' ? 'selected' : '' }}>INSTALACIONES SANITARIAS</option>
                  <option value="PRESUPUESTO" {{ $usuario->especialidadUsuario == 'PRESUPUESTO' ? 'selected' : '' }}>PRESUPUESTO</option>
                  <option value="EVALUACION DE RIESGOS " {{ $usuario->especialidadUsuario == 'EVALUACION DE RIESGOS ' ? 'selected' : '' }}>EVALUACION DE RIESGOS </option>
                  <option value="EQUIPAMIENTO" {{ $usuario->especialidadUsuario == 'EQUIPAMIENTO' ? 'selected' : '' }}>EQUIPAMIENTO</option>
                  <option value="TRASPORTES" {{ $usuario->especialidadUsuario == 'TRASPORTES' ? 'selected' : '' }}>TRASPORTES</option>
                  <option value="SANEAMIENTO FÍSICO LEGAL" {{ $usuario->especialidadUsuario == 'SANEAMIENTO FÍSICO LEGAL' ? 'selected' : '' }}>SANEAMIENTO FÍSICO LEGAL</option>
                  <option value="MODELADOR BIN" {{ $usuario->especialidadUsuario == 'MODELADOR BIN' ? 'selected' : '' }}>MODELADOR BIN</option>
                  <option value="CORDINADOR BIN" {{ $usuario->especialidadUsuario == 'CORDINADOR BIN' ? 'selected' : '' }}>CORDINADOR BIN</option>
                </select>
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