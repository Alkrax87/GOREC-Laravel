<form action="{{ route('usuario.update', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade text-left" id="ModalEdit{{$usuario->idUsuario}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('Edita Usuario') }}</h4>
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
                <strong>NOMBREn:</strong>
                <input type="text" name="nombreUsuario" value="{{ $usuario->nombreUsuario}}" class="form-control" placeholder="Nombre">
                <strong>APELLIDOS:</strong>
                <input type="text" name="apellidoUsuario" value="{{ $usuario->apellidoUsuario}}"  class="form-control" placeholder="Apellidos">
                <strong>CORREO</strong>
                <input type="text" name="email" value="{{$usuario->email}}"   class="form-control" placeholder="Correo">
                <strong>CONTRASEÑA</strong>
                <input type="password" name="password"  value="{{$usuario->password}}"  class="form-control" placeholder="***********">
                <strong>PROFESION</strong>
                <select id="profesion" type="text" name="profesionUsuario"  class="form-control">
                  <option>Seleccione una Profesion</option>
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
                <strong>ESPECIALIDAD</strong>
                <select id="especialidad"  name="especialidadUsuario" class="form-control">
                  <option>Seleccione una Especialidad</option>
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
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <a class="btn btn-primary" data-dismiss="modal" href="{{ route('usuario.index') }}">Volver</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>