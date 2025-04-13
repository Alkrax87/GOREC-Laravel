@extends('adminlte::page')

@section('title', 'Comentario')

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
                <select name="idInversion" id="idInversiones{{$comentarios->idComentarioInversion}}" class="form-select form-select-sm input-auth" required>
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
                  <input type="text" name="asuntoComentarioInversion" value="{{ $comentarios->asuntoComentarioInversion  }}" class="input-auth" placeholder="Nombre Segmento" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label">Descripción</label>
                <textarea class="form-control input-auth" name="comentariosInversion" placeholder="Ingrese Descripción" rows="4" required>{{ $comentarios->comentariosInversion}}</textarea>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
     body {
      background-color: #000;
    }
    section {
      margin-top: 100px;
    }
    /* Input Style  */
    .input-auth {
      display: block;
      width: 100%;
      height: calc(1.5em + 0.75rem + 2px);
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: all 0.3s ease-in-out;
    }
    .input-auth:focus {
      border-color: #72081f;
      outline: none;
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .input-autht:focus::placeholder {
      color: transparent;
    }
    a {
      text-decoration: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered { 
      line-height: 24px;
      padding-left: 10px; /* Ajustar el padding izquierdo */
       /* Asegurar que el texto esté alineado a la izquierda */
    }
    .select2-container .select2-selection--single {
      height: 35px;
      padding-left: 0px; /* Ajustar el padding izquierdo */
    }
      .select2-container .select2-dropdown {
        z-index: 9999;
      }
      .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable  {
        background-color: #9C0C27 !important; /* Cambia este color al que desees */
        color: rgb(248, 243, 243) !important;/* Cambia el color del texto si es necesario */
    }
  </style>
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
