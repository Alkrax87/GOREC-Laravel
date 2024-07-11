<form action="{{ route('subfase.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="ModalSubFaseCreate{{ $especialidad->idEspecialidad }}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Agregar Sub Fase</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idFase">Fase</label>
                        <select name="idFase" id="idFase" class="form-select form-select-sm input-auth" required>
                            <option value="" disabled selected>Selecciona una Fase</option>
                            @foreach ($fases as $fase)
                                <option value="{{ $fase->idFase }}">{{ $fase->nombreFase}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h4><b>Subfases</b></h4>
                    <div id="subfases-container">
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
                    <button type="button" id="add-subfase" class="btn btn-secondary" onclick="addSubfase()">Añadir Subfase</button>
                    <button type="submit" class="btn btn-primary">Crear Subfase</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Script para añadir subfase -->
<script>
    let index = 1;  // Inicializar índice fuera de la función

    function addSubfase() {
        const container = document.getElementById('subfases-container');
        const div = document.createElement('div');
        div.className = 'subfase';  // Corregir la clase a 'subfase'
        div.innerHTML = `
        <h4>-----------------------------------------------</h4>
        <div class="subfase">
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
        </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
            
        `;
        container.appendChild(div);
        index++;  // Incrementar el índice para la próxima subfase
    }

    function removeElement(element) {
        element.parentNode.remove();
    }
</script>



