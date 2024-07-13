<form action="{{ route('subfase.store') }}" method="POST">
    @csrf

    <div class="modal fade" id="ModalSubFaseCreate{{ $fase->idFase }}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Agregar Sub Actividad</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idFase">Fase</label>
                        <select name="idFase" class="form-select form-select-sm input-auth" required>
                            <option value="" disabled selected>Selecciona una Actividad</option>
                            @foreach ($fases as $f)
                                <option value="{{ $f->idFase }}" {{ $f->idFase == $fase->idFase ? 'selected' : '' }}>
                                    {{ $f->nombreFase }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <h4><b>Subfases</b></h4>
                    <div id="subfases-container-{{ $fase->idFase }}">
                        <div class="subfase">
                            <div class="form-group">
                                <label for="subfases[0][nombreSubfase]">Nombre Subfase</label>
                                <input type="text" name="subfases[0][nombreSubfase]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][fechaInicioSubfase]">Fecha Inicio Subfase</label>
                                <input type="date" name="subfases[0][fechaInicioSubfase]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][fechaFinalSubfase]">Fecha Final Subfase</label>
                                <input type="date" name="subfases[0][fechaFinalSubfase]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][avance_por_usuario_realSubFase]">Avance Real</label>
                                <input type="text" name="subfases[0][avance_por_usuario_realSubFase]" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary" onclick="addSubfase({{ $fase->idFase }})">Añadir Subfase</button>
                    <button type="submit" class="btn btn-primary">Crear Subfase</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Script para añadir subfase -->
<script>
    function addSubfase(faseId) {
        const container = document.getElementById('subfases-container-' + faseId);
        const index = container.children.length;
        const div = document.createElement('div');
        div.className = 'subfase';
        div.innerHTML = `
            <hr>
            <div class="form-group">
                <label for="subfases[${index}][nombreSubfase]">Nombre Subfase</label>
                <input type="text" name="subfases[${index}][nombreSubfase]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subfases[${index}][fechaInicioSubfase]">Fecha Inicio Subfase</label>
                <input type="date" name="subfases[${index}][fechaInicioSubfase]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subfases[${index}][fechaFinalSubfase]">Fecha Final Subfase</label>
                <input type="date" name="subfases[${index}][fechaFinalSubfase]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subfases[${index}][avance_por_usuario_realSubFase]">Avance Real</label>
                <input type="text" name="subfases[${index}][avance_por_usuario_realSubFase]" class="form-control" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
        `;
        container.appendChild(div);
    }

    function removeElement(element) {
        element.parentNode.remove();
    }
</script>




