@extends('adminlte::page')

@section('title', 'Detalle Inversion')

@section('content_header')
  <h1><i class="fas fa-users-cog"></i> Detalle Inversion "{{ $inversion->nombreInversion }}"</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <div class="col-12 py-2">
          <b><i class="fas fa-tag"></i> CUI:</b>&nbsp; {{ $inversion->cuiInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-file-signature"></i> Nombre:</b>&nbsp; {{ $inversion->nombreInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-file-signature"></i> Nombre Corto:</b>&nbsp; {{ $inversion->nombreCortoInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-portrait"></i> Responsable:</b>&nbsp; {{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}
          ( P:
          @if ($inversion->usuario->profesiones->isNotEmpty())
              @foreach ($inversion->usuario->profesiones as $profesion)
                {{ $profesion->nombreProfesion }}
                @if (!$loop->last)
                    ,
                @endif
              @endforeach
          @endif
          )
          &nbsp; | &nbsp;
          ( E:
          @if ($inversion->usuario->especialidades->isNotEmpty())
              @foreach ($inversion->usuario->especialidades as $especialidad)
                {{ $especialidad->nombreEspecialidad }}
                @if (!$loop->last)
                    ,
                @endif
              @endforeach
          @endif
          )
        </div>
        @if ($inversion->cordinador)
            <div class="col-12 py-2">
                <b><i class="fas fa-portrait"></i> Coordinador:</b>&nbsp;
                {{ strtoupper(optional($inversion->cordinador)->nombreUsuario . ' ' . optional($inversion->cordinador)->apellidoUsuario ?? 'Sin coordinador') }}
                ( P:
                @if (optional(optional($inversion->cordinador)->profesiones)->isNotEmpty())
                    @foreach (optional($inversion->cordinador)->profesiones as $profesion)
                        {{ $profesion->nombreProfesion }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @else
                    Sin profesiones
                @endif
                )
                &nbsp; | &nbsp;
                ( E:
                @if (optional(optional($inversion->cordinador)->especialidades)->isNotEmpty())
                    @foreach (optional($inversion->cordinador)->especialidades as $especialidad)
                        {{ $especialidad->nombreEspecialidad }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @else
                    Sin especialidades
                @endif
                )
            </div>
        @endif

        <div class="col-6 py-2">
          <b><i class="fas fa-map-marker-alt"></i> Provincia:</b>&nbsp; {{ $inversion->provinciaInversion }}
        </div>
        <div class="col-6 py-2">
          <b><i class="fas fa-map-marker-alt"></i> Distrito:</b>&nbsp; {{ $inversion->distritoInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-layer-group"></i> Nivel:</b>&nbsp; {{ $inversion->nivelInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-cogs"></i> Función:</b>&nbsp; {{ $inversion->funcionInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-stream"></i> Modalidad:</b>&nbsp; {{ $inversion->modalidadInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-info"></i> Estado:</b>&nbsp; {{ $inversion->estadoInversion }}
        </div>
        <div class="col-12 py-2">
          <b><i class="fas fa-percentage"></i> Avance:</b>&nbsp; {{ $inversion->avanceInversion }}%
        </div>
        <div class="col-6 py-2">
          <b><i class="fas fa-calendar-alt"></i> Fecha Inicio:</b>&nbsp; {{ $inversion->fechaInicioInversion }}
        </div>
        <div class="col-6 py-2">
          <b><i class="fas fa-calendar-alt"></i> Fecha Final:</b>&nbsp; {{ $inversion->fechaFinalInversion }}
        </div>
        <div class="col-6 py-2">
          <b><i class="fas fa-file-invoice-dollar"></i> Formulación:</b>&nbsp; {{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}
        </div>
        <div class="col-6 py-2">
          <b><i class="fas fa-file-invoice-dollar"></i> Ejecución:</b>&nbsp; {{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}
        </div>
        @if ($inversion->archivoInversion)
          <div class="col-12 py-2">
            <b><i class="fas fa-file-pdf"></i> Archivo: &nbsp;</b><a class="btn btn-dark" href="{{ route('inversion.download', $inversion->idInversion) }}"><i class="fas fa-file-download"></i>&nbsp;&nbsp; Descargar Archivo</a>
          </div>
        @endif
        <div class="col-12 mt-4 text-center">
          <a href="{{ route('inversion.index') }}" class="btn btn-primary mx-1">
            <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('content_top_nav_right')
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-danger ml-3 navbar-badge"> {{ count($notificaciones) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; min-width: 600px;">
      <spa style="background-color: #9C0C27; color: azure;" class="dropdown-item dropdown-header text-center"><i class="fas fa-bell"></i> {{ count($notificaciones) }} Notificationes</spa>
      <div class="dropdown-divider"></div>
      @foreach ($notificaciones as $notificacion)
        <div class="dropdown-item">
          <span><i class="fas fa-clipboard-list"></i>&nbsp; <b>INVERSIÓN</b></span>
          <p>{{ $notificacion->nombreCortoInversion }} esta por finalizar.</p>
          <p class="pt-2 text-end"><i class="fas fa-calendar-alt"></i> Fecha de finalización: {{ $notificacion->fechaFinalInversion }}</p>
        </div>
      @endforeach
      <div class="dropdown-divider"></div>
    </div>
  </li>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@stop

@section('js')
@stop

