<form action="{{ route('segmento.update', $segmento->idSegmento) }}" method="POST">
  {{ method_field('patch') }}
  {{ csrf_field() }}
  <div class="modal fade" id="ModalEdit{{$segmento->idSegmento}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-stream"></i> Editar Segmento</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <b>Error!</b> Por favor corrige los errores en el formulario.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label">Nombre Segmento</label>
                <input type="text" name="nombreSegmento" value="{{ $segmento->nombreSegmento }}" class="form-control" required/>
              </div>
              <div class="row">
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Inicio</label>
                  <input type="date" name="fechaInicioSegmento" value="{{ $segmento->fechaInicioSegmento }}" class="form-control" required/>
                </div>
                <div class="col-6 form-outline mb-4">
                  <label class="form-label">Fecha Final</label>
                  <input type="date" name="fechaFinalSegmento" value="{{ $segmento->fechaFinalSegmento }}" class="form-control" required/>
                </div>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                <select name="idInversion" id="idInversions{{$segmento->idSegmento}}" class="form-select" required>
                  <option value="" disabled selected>Selecciona una inversión</option>
                  @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}" {{ $segmento->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                      {{ $inversion->nombreCortoInversion }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="idUsuario">Usuario</label>
                <select name="idUsuario" id="idUsuarios{{$segmento->idSegmento}}" class="form-select" required>
                  <option value="" disabled selected>Selecciona un usuario</option>
                  @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->idUsuario }}" {{ $segmento->idUsuario == $usuario->idUsuario ? 'selected' : '' }}>
                      {{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }}
                      P: (
                        @if ($usuario->profesiones->isNotEmpty())
                          @foreach ($usuario->profesiones as $profesion)
                            {{ $profesion->nombreProfesion }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )
                        &nbsp; | &nbsp;
                        E: (
                        @if ($usuario->especialidades->isNotEmpty())
                          @foreach ($usuario->especialidades as $especialidad)
                            {{ $especialidad->nombreEspecialidad }}
                            @if (!$loop->last)
                              ,
                            @endif
                          @endforeach
                        @endif
                        )
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-12 py-2 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    $('#ModalEdit{{$segmento->idSegmento}}').on('shown.bs.modal', function () {
      $('#idInversions{{$segmento->idSegmento}}').select2({
        placeholder: "Selecciona una inversión",
        allowClear: true,
          language: {
            noResults: function() {
              return "No se encontró la inversión";
            }
          }
      });
      $('#idUsuarios{{$segmento->idSegmento}}').select2({
        placeholder: "Selecciona un usuario",
        allowClear: true,
          language: {
            noResults: function() {
              return "No se encontró el usuario";
            }
          }
      });
    });

    // Destruye Select2 cuando el modal se cierra para evitar problemas
    $('#ModalEdit{{$segmento->idSegmento}}').on('hidden.bs.modal', function () {
      $('#idInversions{{$segmento->idSegmento}}').select2('destroy');
      $('#idUsuarios{{$segmento->idSegmento}}').select2('destroy');
    });
  });
</script>