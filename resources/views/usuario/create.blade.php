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
                                <input type="text" name="nombreUsuarios" class="form-control" placeholder="Nombre">
                                <strong>APELLIDOS:</strong>
                                <input type="text" name="apellidoUsuarios" class="form-control" placeholder="Apellidos">
                                <strong>CORREO:</strong>
                                <input type="text" name="email" class="form-control" placeholder="Correo">
                                <strong>CONTRASEÑA:</strong>
                                <input type="password" name="password" class="form-control" placeholder="**********">
                                
            
                                <strong>PROFESION:</strong>
                                <select id="profesion" name="profesionUsuarios" class="form-control">
                                    <option value="">Seleccione una Profesion</option>
                                    <option value="abancay">INGENIERIA CIVIL</option>
                                    <option value="andahuaylas"> INGENIERIA MECANICA</option>
                                    <option value="chincheros">INGENIERIA SANITARIA</option>
                                    <option value="abancay">INGENIERIA ELECTRICA</option>
                                    <option value="andahuaylas">INGENIERIA AMBIENTAL </option>
                                    <option value="chincheros">INGENIERIA DE SISTEMAS </option>
                                    <option value="abancay">ARQUITECTO</option>
                                    <option value="andahuaylas">ARQUEOLOGO</option>
                                    <option value="chincheros">ABOGADO</option>
                                    <option value="chincheros">ECONOMISTA</option>
                                    <!-- Agrega más provincias según sea necesario -->
                                </select>

                                <strong>ESPECIALIDAD:</strong>
                                <select id="especialidad" name="especialidadUsuarios" class="form-control">
                                    <option value="">Seleccione una Especialidad</option>
                                    <option value="abancay">ARQUITECTURA</option>
                                    <option value="andahuaylas">CAPACITACION</option>
                                    <option value="chincheros">ARQUEOLOGIA</option>
                                    <option value="abancay">COMUNICACIONES</option>
                                    <option value="andahuaylas">ESTRUCTURAS</option>
                                    <option value="chincheros">ESTUDIOS ECONOMICOS</option>
                                    <option value="andahuaylas">GESTION DE RIESGOS</option>
                                    <option value="chincheros">IMPACTO AMBIENTAL</option>
                                    <option value="abancay">INSTALACIONES ELECTRICAS</option>
                                    <option value="andahuaylas">INSTALACIONES MECANICAS</option>
                                    <option value="chincheros">INSTALACIONES SANITARIAS</option>
                                    <option value="chincheros">PRESUPUESTO</option>
                                    <option value="abancay">EVALUACION DE RIESGOS </option>
                                    <option value="andahuaylas">EQUIPAMIENTO</option>
                                    <option value="chincheros">TRASPORTES</option>
                                    <option value="abancay">SANEAMIENTO FISICO LEGAL  </option>
                                    <option value="andahuaylas">MODELADOR BIN</option>
                                    <option value="chincheros">CORDINADOR BIN</option>
                                    <!-- Agrega más provincias según sea necesario -->
                                </select>
                               

                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('usuario.index') }}"> Volver</a>
                            <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


