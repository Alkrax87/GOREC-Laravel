@extends('adminlte::page')

@section('title', 'Inversion • Registro Estado')

@section('content_header')
  <h1><i class="fas fa-users-cog"></i> Registro de Cambios de Estado "{{ $inversion->nombreInversion }}"</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <h3>{{ $inversion->nombreCortoInversion }}</h3>
        <div class="container-fluid px-0 pt-3">
          @foreach ($logs as $log)
            <div class="card">
              <div class="card-header">
                <b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp;  {{ $log->fechaCambioEstado ? \Carbon\Carbon::parse($log->fechaCambioEstado)->format('d/m/Y  H:i:s') : 'Por Definir' }}
                <!--<b><i class="fas fa-calendar-alt"></i> Fecha:</b>&nbsp; {{ $log->fechaCambioEstado }}-->
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <b><i class="fas fa-info"></i> Estado Anterior:</b>&nbsp; {{ $log->estadoInversionOLD }}
                  </div>
                  <div class="col-6">
                    <b><i class="fas fa-info"></i> Estado Cambiado:</b>&nbsp; {{ $log->estadoInversionNEW }}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
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
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop