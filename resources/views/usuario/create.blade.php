<form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('Crear Nuevo Usuario') }}</h4>
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
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>NOMBRE:</strong>
                <input type="text" name="nombreUsuario" class="form-control" placeholder="Nombre">
                <strong>APELLIDOS:</strong>
                <input type="text" name="apellidoUsuario" class="form-control" placeholder="Apellidos">
                <strong>CORREO:</strong>
                <input type="text" name="email" class="form-control" placeholder="Correo">
                <strong>CONTRASEÑA:</strong>
                <input type="password" name="password" class="form-control" placeholder="**********">
                <strong>PROFESION:</strong>
                <select id="profesion" name="profesionUsuario" class="form-control">
                    <option>Seleccione una Profesion</option>
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
                <strong>ESPECIALIDAD:</strong>
                <select id="especialidad" name="especialidadUsuario" class="form-control">
                  <option>Seleccione una Especialidad</option>
                  <option value="ARQUITECTURA">ARQUITECTURA</option>
                  <option value="CAPACITACIÓN">CAPACITACIÓN</option>
                  <option value="ARQUEOLOGÍA">ARQUEOLOGÍA</option>
                  <option value="COMUNICACIONES">COMUNICACIONES</option>
                  <option value="ESTRUCTURAS">ESTRUCTURAS</option>
                  <option value="ESTUDIOS ECONÓMICOS">ESTUDIOS ECONÓMICOS</option>
                  <option value="GESTIÓN DE RIESGOS">GESTIÓN DE RIESGOS</option>
                  <option value="IMPACTO AMBIENTAL">IMPACTO AMBIENTAL</option>
                  <option value="INSTALACIONES ELÉCTRICAS">INSTALACIONES ELÉCTRICAS</option>
                  <option value="INSTALACIONES MECÁNICAS">INSTALACIONES MECÁNICAS</option>
                  <option value="INSTALACIONES SANITARIAS">INSTALACIONES SANITARIAS</option>
                  <option value="PRESUPUESTO">PRESUPUESTO</option>
                  <option value="EVALUACIÓN DE RIESGOS">EVALUACIÓN DE RIESGOS</option>
                  <option value="EQUIPAMIENTO">EQUIPAMIENTO</option>
                  <option value="TRASPORTES">TRASPORTES</option>
                  <option value="SANEAMIENTO FÍSICO LEGAL">SANEAMIENTO FÍSICO LEGAL</option>
                  <option value="MODELADOR BIN">MODELADOR BIN</option>
                  <option value="CORDINADOR BIN">CORDINADOR BIN</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <a class="btn btn-primary" data-dismiss="modal" href="{{ route('usuario.index') }}"> Volver</a>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


