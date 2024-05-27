<form action="{{ route('inversion.update', $inversion->idInversion) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalEdit{{$inversion->idInversion}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edita Inversion') }}</h4>
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
                                <strong>CUI:</strong>
                                <input type="text" name="cuiInversion" value="{{ $inversion->cuiInversion }}" class="form-control" placeholder="CUI">
                                <strong>Nombre Inversion:</strong>
                                <input type="text" name="nombreInversion" value="{{ $inversion->nombreInversion }}"  class="form-control" placeholder="Nombre de la inversión">
                                <strong>Nombre Corto Inversion:</strong>
                                <input type="text" name="nombreCortoInversion" value="{{ $inversion->nombreCortoInversion}}" class="form-control" placeholder="Nombre corto de la inversión">
                                <strong>Nivel Inversion:</strong>
                                <input type="text" name="nivelInversion" value="{{ $inversion->nivelInversion }}" class="form-control" placeholder="Nivel de la inversión">
                                <strong>Provincia Inversion:</strong>
                                <input type="text" name="provinciaInversion" value="{{ $inversion->provinciaInversion }}" class="form-control" placeholder="Provincia de la inversión">
                                <strong>Distrito Inversion:</strong>
                                <input type="text" name="distritoInversion" value="{{ $inversion->distritoInversion }}" class="form-control" placeholder="Distrito de la inversión">
                                <strong>Función Inversion:</strong>
                                <input type="text" name="funcionInversion" value="{{ $inversion->funcionInversion}}" class="form-control" placeholder="Función de la inversión">
                                
                                <strong>PRESUPUESTO FORMULACION:</strong>
                                <input type="text" name="presupuestoFormulacionInversion" value="{{ $inversion->presupuestoFormulacionInversion}}" class="form-control" placeholder="Función de la inversión">
                                <strong>PRESUPUESTO EJECUCION:</strong>
                                <input type="text" name="presupuestoEjecucionfuncionInversion" value="{{ $inversion->presupuestoEjecucionfuncionInversion}}" class="form-control" placeholder="Función de la inversión">
                                <strong>MODALIDAD DE EJECUCION:</strong>
                                <input type="text" name="modalidadEjecucionInversion" value="{{ $inversion->modalidadEjecucionInversion}}" class="form-control" placeholder="Función de la inversión">
                                <strong>ESTADO DE INVERSION:</strong>
                                <input type="text" name="estadoInversion" value="{{ $inversion->estadoInversion}}" class="form-control" placeholder="Función de la inversión">
                                
                                
            
                                <strong>Fecha Inicio:</strong>
                                <input type="date" name="fechaInicioInversion" value="{{ $inversion->fechaInicioInversion }}" class="form-control" placeholder="Fecha de la inversión">
                                <strong>Fecha Final:</strong>
                                <input type="date" name="fechaFinalInversion" value="{{ $inversion->fechaFinalInversion}}" class="form-control" placeholder="Fecha de la inversión">
                            </div>
                        </div>
                        <!-- Agrega aquí los demás campos de tu modelo -->
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('inversion.index') }}"> Volver</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>