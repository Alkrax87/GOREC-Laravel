<form action="{{ route('asignaciones.update', $asistente->usuario->idUsuario) }}" method="POST">
    {{ method_field('patch') }}
    {{ csrf_field() }}
     <!-- Token CSRF para la seguridad -->
    <!-- Campo oculto para enviar el ID del usuario -->
    <input type="hidden" name="idUsuario" value="{{ $asistente->usuario->idUsuario }}">

    <div class="modal fade text-left" id="Modalobservacion{{ $asistente->usuario->idUsuario }}{{ $inversion->idInversion }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-eye"></i> Observación Asistente  {{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control input-auth" name="ObservacionUser" placeholder="Ingrese Observacion" rows="4">{{ $asistente->usuario->ObservacionUser }}</textarea>
                </div>
                <div class="modal-footer">
                    <!-- Botón de submit para enviar el formulario -->
                    <button type="submit" class="btn btn-success mx-1"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar</button>
                    <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
                </div>
            </div>
        </div>
    </div>
</form>


