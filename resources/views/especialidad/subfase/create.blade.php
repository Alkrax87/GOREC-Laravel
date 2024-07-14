<form action="{{ route('subfase.store') }}" method="POST">
    @csrf

    <div class="modal fade" id="ModalSubFaseCreate{{ $fase->idFase }}">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-tie"></i> Agregar Sub Actividades</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!-- <select type="hidden" name="idFase" class="form-select form-select-sm input-auth" required>
                            <option value="" disabled selected>Selecciona una Actividad</option>  -->
                            <input type="hidden" name="idFase" value="{{ $fase->idFase}}">

                              <!-- Mostrar el nombre de la especialidad correspondiente -->
                              <p>Especialidad: {{ $fase->nombreFase  }}</p>
                                
                            
                        <!--</select>-->
                    </div>
                    <div id="subfases-container-{{ $fase->idFase }}">
                        <div class="subfase">
                            <div class="form-group">
                                <label for="subfases[0][nombreSubfase]">Nombre Sub Actividad</label>
                                <input type="text" name="subfases[0][nombreSubfase]" class="form-control" required placeholder="ingrese nombre">
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][fechaInicioSubfase]">Fecha Inicio Sub Actividad</label>
                                <input type="date" name="subfases[0][fechaInicioSubfase]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][fechaFinalSubfase]">Fecha Final Sub Actividad</label>
                                <input type="date" name="subfases[0][fechaFinalSubfase]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="subfases[0][avance_por_usuario_realSubFase]">Avance (%)</label>
                                <input type="number" name="subfases[0][avance_por_usuario_realSubFase]" class="form-control" required min="0" max="100" step="0.01" placeholder="ingrese avance">
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
                <label for="subfases[${index}][fechaInicioSubfase]">Fecha Inicio Sub Actividad</label>
                <input type="date" name="subfases[${index}][fechaInicioSubfase]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subfases[${index}][fechaFinalSubfase]">Fecha Final Sub Actividad</label>
                <input type="date" name="subfases[${index}][fechaFinalSubfase]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subfases[${index}][avance_por_usuario_realSubFase]">Avance Real</label>
                <input type="number" name="subfases[${index}][avance_por_usuario_realSubFase]" class="form-control" required min="0" max="100" step="0.01">
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)"><i class="fas fa-trash-alt"></i></button>
        `;
        container.appendChild(div);
    }

    function removeElement(element) {
        element.parentNode.remove();
    }
</script>




