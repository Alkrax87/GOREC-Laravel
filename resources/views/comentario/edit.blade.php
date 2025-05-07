@extends('adminlte::page')

@section('title', 'Comentario • Editar')

@section('content_header')
  <h1><i class="fas fa-comments"></i> Editar Comentario</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <form action="{{ route('comentario.update', $comentarios->idComentarioInversion) }}" method="POST">
          @csrf
          @method('POST')
          <div class="row">
            <div class="col-12">
              <div class="form-outline mb-4">
                <label class="form-label" for="idInversion">Inversión</label>
                <select name="idInversion" id="idInversiones{{$comentarios->idComentarioInversion}}" class="form-select" required>
                <option value="" disabled>Selecciona una inversión</option>
                @foreach ($inversiones as $inversion)
                    <option value="{{ $inversion->idInversion }}" {{ $comentarios->idInversion == $inversion->idInversion ? 'selected' : '' }}>
                    {{ $inversion->nombreCortoInversion }}
                    </option>
                @endforeach
                </select>
              </div>
              <div class="form-outline mb-4">
                  <label class="form-label">Asunto</label>
                  <input type="text" name="asuntoComentarioInversion" value="{{ $comentarios->asuntoComentarioInversion  }}" class="form-control" placeholder="Nombre Segmento" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="comentariosInversion" placeholder="Ingrese Descripción" rows="4" required>{{ $comentarios->comentariosInversion}}</textarea>
              </div>
            </div>
            <div class="col-12 py-2 text-center">
              <a href="{{ route('comentario.index') }}" class="btn btn-primary mx-1">
                <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
              </a>
              <button type="submit" class="btn btn-warning mx-1"><i class="fas fa-edit"></i>&nbsp;&nbsp; Editar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('js')
  <script>
      $(document).ready(function() {
          $('#idInversiones{{$comentarios->idComentarioInversion}}').select2({
              placeholder: "Selecciona una inversión",
              allowClear: true,
              width: '100%',
              language: {
                  noResults: function() {
                      return "No se encontró la inversión";
                  }
              }
          });
      });
  </script>
@stop
