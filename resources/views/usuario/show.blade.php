<form action="{{ route('usuario.show', $usuario->idUsuario) }}" method="POST">
  {{ csrf_field() }}
  <div class="modal fade" id="ModalShow{{$usuario->idUsuario}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-users"></i> Detalle Usuario</h4>
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
            @if ($usuario->email)
              <div class="col-12 py-2">
                <b>Usuario:</b>&nbsp; {{ str_replace('@gorec.com', '', $usuario->email) }}
              </div>
            @endif
            @if ($usuario->profesiones)
            <div class="col-12 pt-2">
              <b>Profesión:</b>
              <ul>
                @foreach ($usuario->profesiones as $profesion)
                  <li>{{ $profesion->nombreProfesion }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            @if ($usuario->especialidades)
              <div class="col-12">
                <b>Especialidad:</b>
                <ul>
                  @foreach ($usuario->especialidades as $especialidad)
                    <li>{{ $especialidad->nombreEspecialidad }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>