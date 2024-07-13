<form action="{{ route('fase.update', $fase->idFase) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal fade" id="ModalEditFase{{ $fase->idFase}}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Actualizar Actividad</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                    <h2>Actualizar Avance</h2>
                            <div class="form-outline mb-4">
                                <label class="form-label">Nombre Fase</label>
                                <input type="text" name="nombreFase" value="{{ $fase->nombreFase  }}" class="input-auth" placeholder="Nombre Fase" required/>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Avance</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>