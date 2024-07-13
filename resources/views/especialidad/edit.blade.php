<form action="{{ route('especialidad.update', $especialidad->idEspecialidad) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade" id="ModalEditEspecialidad{{ $especialidad->idEspecialidad}}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Actualizar Especialidad</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                            <div class="form-outline mb-4">
                                <label class="form-label">Nombre Especialidad</label>
                                <input type="text" name="nombreEspecialidad" value="{{ $especialidad->nombreEspecialidad}}" class="input-auth" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="porcentajeAvanceEspecialidad">Avance Porcentaje Programado(%)</label>
                                <input type="number" name="porcentajeAvanceEspecialidad" value="{{ $especialidad->porcentajeAvanceEspecialidad}}" class="form-control" required min="0" max="100" step="0.01">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>