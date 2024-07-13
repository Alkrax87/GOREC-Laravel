<!-- resources/views/subfase/update.blade.php -->
<form action="{{ route('subfase.update', $subfase->idSubfase) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade" id="ModalEditSubFase{{ $subfase->idSubfase}}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Actualizar Sub Actividad</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                    <h2>Actualizar Avance</h2>
                            <div class="form-outline mb-4">
                                <label class="form-label">Nombre Sub Fase</label>
                                <input type="text" name="nombreSubfase" value="{{ $subfase->nombreSubfase  }}" class="input-auth" placeholder="Nombre Sub Fase" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="avance_por_usuario_realSubFase">Avance por Usuario Real (%)</label>
                                <input type="number" name="avance_por_usuario_realSubFase" value="{{ $subfase->avance_por_usuario_realSubFase}}" class="form-control" required min="0" max="100" step="0.01">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Avance</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>