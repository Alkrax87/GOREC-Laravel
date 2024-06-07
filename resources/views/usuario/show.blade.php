<form action="{{ route('usuario.show', $usuario->idUsuario) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalShow{{$usuario->idUsuario}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detalle Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 py-2">
              <b>Nombres:</b>&nbsp; {{ $usuario->nombreUsuario }}
            </div>
            <div class="col-12 py-2">
              <b>Apellidos:</b>&nbsp; {{ $usuario->apellidoUsuario }}
            </div>
            <div class="col-12 py-2">
              <b>Usuario:</b>&nbsp; {{ $usuario->email }}
            </div>
            <div class="col-12 py-2">
              <b>Profesión:</b>&nbsp; {{ $usuario->profesionUsuario }}
            </div>
            <div class="col-12 py-2">
              <b>Especialidad:</b>&nbsp; {{ $usuario->especialidadUsuario }}
            </div>
            <div class="col-12 py-2 text-center">
              <hr>
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>