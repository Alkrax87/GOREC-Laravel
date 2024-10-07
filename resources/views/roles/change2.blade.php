<form action="{{ route('roles.update', $usuario->idUsuario) }}" method="POST">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalAdministrativo{{$usuario->idUsuario}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="value" value="1">
          <h4 class="modal-title"><i class="fas fa-users"></i>
            @if($usuario->isAdministrador)
              Eliminar privilegios de administrativo
            @else
              Convertir en Usuario administrativo
            @endif
          </h4>
          <button onclick="window.location.href = '{{ route('roles.index') }}'" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          @if($usuario->isAdministrador)
            ¿Estás seguro que deseas eliminar los privilegios de administrativo al usuario <b>{{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}</b>?
          @else
            ¿Estás seguro que deseas convertir al usuario <b>{{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}</b> en administrativo?
          @endif
          <div class="row">
            <div class="col-12 pt-3 text-center">
              <button onclick="window.location.href = '{{ route('roles.index') }}'" class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-success mx-1"><i class="fas fa-user-shield"></i>&nbsp;&nbsp; Aceptar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>