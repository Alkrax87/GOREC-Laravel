<form action="{{ route('inversion.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Crear Nueva Inversión') }}</h4>
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
                                <input type="text" name="cuiInversion" class="form-control" placeholder="CUI">
                                <strong>Nombre Inversión:</strong>
                                <input type="text" name="nombreInversion" class="form-control" placeholder="Nombre de la inversión">
                                <strong>Nombre Corto Inversión:</strong>
                                <input type="text" name="nombreCortoInversion" class="form-control" placeholder="Nombre corto de la inversión">
                                <strong>Nivel Inversión:</strong>
                                <input type="text" name="nivelInversion" class="form-control" placeholder="Nivel de la inversión">
                                
                                <strong>Provincia Inversión:</strong>
                                <select id="provincia" name="provinciaInversion" class="form-control">
                                    <option value="">Seleccione una provincia</option>
                                    <option value="abancay">Abancay</option>
                                    <option value="andahuaylas">Andahuaylas</option>
                                    <option value="chincheros">Chincheros</option>
                                    <!-- Agrega más provincias según sea necesario -->
                                </select>
    
                                <strong>Distrito Inversión:</strong>
                                <select id="distrito" name="distritoInversion" class="form-control">
                                    <option value="">Seleccione un distrito</option>
                                    <!-- Los distritos se llenarán dinámicamente mediante JavaScript -->
                                </select>
                                <strong>Función Inversión:</strong>
                                <input type="text" name="funcionInversion" class="form-control" placeholder="Función de la inversión">
                                
                                <strong>PRESUPUESTO FORMULACION:</strong>
                                <input type="text" name="presupuestoFormulacionInversion" class="form-control" placeholder="Presupuesto Formulacion">
                                <strong>PRESUPUESTO EJECUCION:</strong>
                                <input type="text" name="presupuestoEjecucionfuncionInversion" class="form-control" placeholder="Presupuesto Ejecucion">
                                <strong>MODALIDAD DE EJECUCION:</strong>
                                <select id="provincia" name="modalidadEjecucionInversion" class="form-control">
                                    <option value="">Seleccione una modalidad</option>
                                    <option value="DIRECTA">DIRECTA</option>
                                    <option value="CONTRATA">CONTRATA</option>
                                    <!-- Agrega más provincias según sea necesario -->
                                </select>
                                <strong>ESTADO DE INVERSION:</strong>
                                <select id="distrito" name="estadoInversion" class="form-control">
                                    <option value="">Seleccione un distrito</option>
                                    <option value="POR ELABORAR"> POR ELABORAR</option>
                                    <option value="PARALIZADO">PARALIZADO</option>
                                    <option value="EN ELAVORACION">EN ELAVORACION</option>
                                    <option value="EN GRSLI">EN GRSLI</option>
                                    <option value="EN LEVANTAMIENTO DE OBSERVACIONES">EN LEVANTAMIENTO DE OBSERVACIONES</option>
                                    <option value="CON CONFORMIDAD DE GRSLI">CON CONFORMIDAD DE GRSLI</option>
                                    <option value="EN LEVANTAMIENTO DE OBSERVACIONES">CON REGISTRO DE FASE DE EJECUCION</option>
                                    <option value="CON CONFORMIDAD DE GRSLI">CON RESOLUCION EJECUTIVA </option>
                                    <!-- Los distritos se llenarán dinámicamente mediante JavaScript -->
                                </select>     

                                <strong>Fecha Inicio:</strong>
                                <input type="date" name="fechaInicioInversion" class="form-control" placeholder="Fecha de inicio">
                                <strong>Fecha Final:</strong>
                                <input type="date" name="fechaFinalInversion" class="form-control" placeholder="Fecha final">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" data-dismiss="modal" href="{{ route('inversion.index') }}"> Volver</a>
                            <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const provinciaSelect = document.getElementById('provincia');
            const distritoSelect = document.getElementById('distrito');

            const distritos = {
                abancay: ['Distrito1', 'Distrito2', 'Distrito3'],
                andahuaylas: ['Uripa', 'Hauncambaba', 'Distrito3'],
                chincheros: ['DistritoA', 'DistritoB', 'DistritoC']
                // Añade más provincias y sus distritos correspondientes
            };

            provinciaSelect.addEventListener('change', function () {
                const provincia = this.value;
                const opcionesDistritos = distritos[provincia] || [];

                distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';
                opcionesDistritos.forEach(function (distrito) {
                    const option = document.createElement('option');
                    option.value = distrito;
                    option.textContent = distrito;
                    distritoSelect.appendChild(option);
                });
            });
        });
    </script>
</form>


