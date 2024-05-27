<form action="{{ route('inversion.show', $inversion->idInversion) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalShow{{$inversion->idInversion}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Detalle inversion') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>CUI:</strong>
                                {{ $inversion->cuiInversion }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nombre Inversion:</strong>
                                {{ $inversion->nombreInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nombre Corto Inversion:</strong>
                                {{ $inversion->nombreCortoInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nivel Inversion:</strong>
                                {{ $inversion->nivelInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Provincia Inversion:</strong>
                                {{ $inversion->provinciaInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Distrito Inversion:</strong>
                                {{ $inversion->distritoInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Funcion Inversion:</strong>
                                {{ $inversion->funcionInversion}}
                            
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Fecha Inicio:</strong>
                                {{ $inversion->fechaInicioInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Fecha Final:</strong>
                                {{ $inversion->fechaFinalInversion}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('inversion.index') }}"> Volver</a>
                            
                        </div>
                        <!-- Agrega aquí los demás campos de tu modelo -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 