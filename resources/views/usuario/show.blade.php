<form action="{{ route('usuario.show', $usuario->idUser) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalShow{{$usuario->idUser}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Detalle Usuario') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>NOMBRE:</strong>
                                {{$usuario->nombreUsuarios}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>APELLIDOS:</strong>
                                {{$usuario->apellidoUsuarios}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>USUARIO:</strong>
                                {{ $usuario->email}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>CONTRASEÑA:</strong>
                                {{  $usuario->password}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>PROFESION:</strong>
                                {{ $usuario->profesionUsuarios}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ESPECIALIDAD:</strong>
                                {{ $usuario->especialidadUsuarios}}
                            </div>
                        </div>
        
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('usuario.index') }}"> Volver</a>
                            
                        </div>
                        <!-- Agrega aquí los demás campos de tu modelo -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 