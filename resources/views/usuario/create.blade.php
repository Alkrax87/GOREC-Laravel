<form action="{{ route('usuario.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalCreate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Usuario</h4>
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
                <input type="text" name="nombreUsuario" class="input-auth" placeholder="Nombres" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidoUsuario" class="input-auth" placeholder="Apellidos" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Usuario</label>
                <input type="text" name="email" class="input-auth" placeholder="Usuario" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="input-auth" placeholder="********"/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="profesionUsuario">Profesión</label>
                <select name="profesionUsuario" id="profesionUsuario" class="form-select form-select-sm input-auth" required>
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
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="especialidadUsuario">Especialidad</label>
                <select name="especialidadUsuario" id="especialidadUsuario" class="form-select form-select-sm input-auth" required>
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
              </div>
            </div>
            <div class="col-12 py-2 text-center">
              <hr>
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


