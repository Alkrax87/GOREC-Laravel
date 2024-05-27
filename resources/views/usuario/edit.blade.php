<form action="{{ route('usuario.update', $usuario->idUser) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalEdit{{$usuario->idUser}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <input type="text" name="nombreUsuarios" value="{{ $usuario->nombreUsuarios}}" class="form-control" placeholder="Nombre">
                                <strong>APELLIDOS:</strong>
                                <input type="text" name="apellidoUsuarios" value="{{ $usuario->apellidoUsuarios}}"  class="form-control" placeholder="Apellidos">
                                <strong>CORREO</strong>
                                <input type="text" name="email" value="{{$usuario->email}}"   class="form-control" placeholder="Correo">
                                <strong>CONTRASEÑA</strong>
                                <input type="password" name="password"  value="{{$usuario->password}}"  class="form-control" placeholder="***********">
                                <strong>PROFESION</strong>
                                <select id="profesion" type="text" name="profesionUsuarios"  class="form-control">
                                    <option value="">Seleccione una Profesion</option>
                                    <option value="INGENIERIA CIVIL" {{ $usuario->profesionUsuarios == 'INGENIERIA CIVIL' ? 'selected' : '' }}>INGENIERIA CIVIL</option>
                                    <option value="INGENIERIA MECANICA" {{ $usuario->profesionUsuarios == 'INGENIERIA MECANICA' ? 'selected' : '' }}>INGENIERIA MECANICA</option>
                                    <option value="INGENIERIA SANITARIA" {{ $usuario->profesionUsuarios == 'INGENIERIA SANITARIA' ? 'selected' : '' }}>INGENIERIA SANITARIA</option>
                                    <option value="INGENIERIA ELECTRICA" {{ $usuario->profesionUsuarios == 'INGENIERIA ELECTRICA' ? 'selected' : '' }}>INGENIERIA ELECTRICA</option>
                                    <option value="INGENIERIA AMBIENTAL" {{ $usuario->profesionUsuarios == 'INGENIERIA AMBIENTAL' ? 'selected' : '' }}>INGENIERIA AMBIENTAL</option>
                                    <option value="INGENIERIA DE SISTEMAS" {{ $usuario->profesionUsuarios == 'INGENIERIA DE SISTEMAS' ? 'selected' : '' }}>INGENIERIA DE SISTEMAS</option>
                                    <option value="ARQUITECTO" {{ $usuario->profesionUsuarios == 'ARQUITECTO' ? 'selected' : '' }}>ARQUITECTO</option>
                                    <option value="ARQUEOLOGO" {{ $usuario->profesionUsuarios == 'ARQUEOLOGO' ? 'selected' : '' }}>ARQUEOLOGO</option>
                                    <option value="ABOGADO" {{ $usuario->profesionUsuarios == 'ABOGADO' ? 'selected' : '' }}>ABOGADO</option>
                                    <option value="ECONOMISTA" {{ $usuario->profesionUsuarios == 'ECONOMISTA' ? 'selected' : '' }}>ECONOMISTA</option>
                                   
                                </select>
                                <strong>ESPECIALIDAD</strong>
                                <select id="especialidad"  name="especialidadUsuarios" value="{{ $usuario->especialidadUsuarios}}"   class="form-control">
                                    <option value="">Seleccione una Especialidad</option>
                                    <option value="ARQUITECTURA" {{ $usuario->especialidadUsuarioss == 'ARQUITECTURA' ? 'selected' : '' }}>ARQUITECTURA</option>
                                    <option value="CAPACITACION" {{ $usuario->especialidadUsuarios == 'CAPACITACION' ? 'selected' : '' }}>CAPACITACION</option>
                                    <option value="ARQUEOLOGIA" {{ $usuario->especialidadUsuarios == 'ARQUEOLOGIA' ? 'selected' : '' }}>ARQUEOLOGIA</option>
                                    <option value="COMUNICACIONES" {{ $usuario->especialidadUsuarios == 'COMUNICACIONES' ? 'selected' : '' }}>COMUNICACIONES</option>
                                    <option value="ESTRUCTURAS" {{ $usuario->especialidadUsuarios== 'INGENIERIA ESTRUCTURAS' ? 'selected' : '' }}>ESTRUCTURAS</option>
                                    <option value="ESTUDIOS ECONOMICOS" {{ $usuario->especialidadUsuarios == 'ESTUDIOS ECONOMICOS' ? 'selected' : '' }}>ESTUDIOS ECONOMICOS</option>
                                    <option value="GESTION DE RIESGOS" {{ $usuario->especialidadUsuarios == 'GESTION DE RIESGO' ? 'selected' : '' }}>GESTION DE RIESGO</option>
                                    <option value="IMPACTO AMBIENTAL" {{ $usuario->especialidadUsuarios == 'IMPACTO AMBIENTAL' ? 'selected' : '' }}>IMPACTO AMBIENTAL</option>
                                    <option value="INSTALACIONES ELECTRICAS" {{ $usuario->especialidadUsuarios == 'INSTALACIONES ELECTRICAS' ? 'selected' : '' }}>INSTALACIONES ELECTRICAS</option>
                                    <option value="INSTALACIONES MECANICAS" {{ $usuario->especialidadUsuarios == 'INSTALACIONES MECANICAS' ? 'selected' : '' }}>INSTALACIONES MECANICAS</option>
                                    <option value="INSTALACIONES SANITARIAS" {{ $usuario->especialidadUsuarios == 'INSTALACIONES SANITARIAS' ? 'selected' : '' }}>INSTALACIONES SANITARIAS</option>
                                    <option value="PRESUPUESTO" {{ $usuario->especialidadUsuarios == 'PRESUPUESTO' ? 'selected' : '' }}>PRESUPUESTO</option>
                                    <option value="EVALUACION DE RIESGOS " {{ $usuario->especialidadUsuarios == 'EVALUACION DE RIESGOS ' ? 'selected' : '' }}>EVALUACION DE RIESGOS </option>
                                    <option value="EQUIPAMIENTO" {{ $usuario->especialidadUsuarios == 'EQUIPAMIENTO' ? 'selected' : '' }}>EQUIPAMIENTO</option>
                                    <option value="TRASPORTES" {{ $usuario->especialidadUsuarios == 'TRASPORTES' ? 'selected' : '' }}>TRASPORTES</option>
                                    <option value="SANEAMIENTO FISICO LEGAL" {{ $usuario->especialidadUsuarios == 'SANEAMIENTO FISICO LEGAL' ? 'selected' : '' }}>SANEAMIENTO FISICO LEGAL</option>
                                    <option value="MODELADOR BIN" {{ $usuario->especialidadUsuarios == 'MODELADOR BIN' ? 'selected' : '' }}>MODELADOR BIN</option>
                                    <option value="CORDINADOR BIN" {{ $usuario->especialidadUsuarios == 'CORDINADOR BIN' ? 'selected' : '' }}>CORDINADOR BIN</option>
                                </select>
                           
                            </div>
                        </div>
                        <!-- Agrega aquí los demás campos de tu modelo -->
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('usuario.index') }}"> Volver</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>