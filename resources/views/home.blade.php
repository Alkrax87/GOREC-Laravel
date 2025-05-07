@extends('adminlte::page')

@section('title', 'Home')

@section('content')
  <div class="home">
    <div class="welcome-message">
      <p class="welcome">Bienvenid@</p>
      <b class="user-name">{{ $user->nombreUsuario }} {{ $user->apellidoUsuario }}</b>
    </div>
  </div>

  <div class="container-fluid bottom-svg">
    <div class="row">
      <div class="col">
        <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path fill="#9C0C27" fill-opacity="1" d="M0,256L80,229.3C160,203,320,149,480,160C640,171,800,245,960,250.7C1120,256,1280,192,1360,160L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
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
      <span class="gorec-notifications dropdown-header text-center"><i class="fas fa-bell"></i> {{ count($notificaciones) }} Notificationes</span>
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
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop