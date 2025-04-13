@extends('adminlte::page')

@section('title', 'Comentario')

@section('content_header')
  <h1><i class="fas fa-comments"></i> Detalle Comentario</h1>
@stop

@section('content')
<form action="{{ route('comentario.show', $comentarios->idComentarioInversion) }}" method="POST">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-2 py-2">
                    <b><i class="fas fa-file-signature"></i> <span style="font-size: 18px;"> Inversión:</span></b> &nbsp; {{ $comentarios->inversion->nombreInversion}}
                </div>
                <div class="col-12 py-2">
                    <b><i class="fas fa-user-tie"></i> Proyectista:</b>&nbsp; {{ $comentarios->usuario->nombreUsuario . ' ' . $comentarios->usuario->apellidoUsuario }}
                    <br>
                    P: (
                        @if ($comentarios->usuario->profesiones->isNotEmpty())
                        @foreach ($comentarios->usuario->profesiones as $profesion)
                            {{ $profesion->nombreProfesion }}
                            @if (!$loop->last)
                            ,
                            @endif
                        @endforeach
                        @endif
                        )
                        &nbsp; | &nbsp;
                        E: (
                        @if ($comentarios->usuario->especialidades->isNotEmpty())
                        @foreach ($comentarios->usuario->especialidades as $especialidad)
                            {{ $especialidad->nombreEspecialidad }}
                            @if (!$loop->last)
                            ,
                            @endif
                        @endforeach
                        @endif
                        )
                </div>
                <div class="col-12 mt-2">
                    <div class="card text-white bg-dark mb-5">
                        <div class="row">
                            <div class="col-6 py-2 px-3">
                                <b><i class="fas fa-envelope-open-text"></i> Asunto:</b>&nbsp; {{ $comentarios->asuntoComentarioInversion}}
                                </div>
                                <div class="col-2 py-2">
                                    <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{  $comentarios->fechaComentarioInversion ? \Carbon\Carbon::parse( $comentarios->fechaComentarioInversion)->format('d/m/Y') : 'Por Definir' }}
                                    </div>
                                <div class="col-12 py-2 px-4">
                                <b><i class="fas fa-pencil-alt"></i> Descripción:</b>&nbsp; {{ $comentarios->comentariosInversion}}
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-2 text-center">
                    <hr>
                    <a href="{{ route('comentario.index') }}" class="btn btn-primary mx-1">
                        <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop


@section('css')

@stop

@section('js')
@stop