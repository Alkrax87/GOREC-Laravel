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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
    a {
      text-decoration: none;
    }
    .dropdown-item:active {
      background-color: #F8F9FA;
      color: black;
    }
    .home {
      display: flex;
      justify-content: center;
      align-items: center;
      height: ;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .welcome{
      font-size: 25px;
      margin-bottom: -20px;
    }
    .bottom-svg {
      position: absolute;
      bottom: 0;
      width: 97.5%;
      padding: 0px;
      height: auto;
    }
    .welcome-message {
      text-align: left;
      padding-top: 18%;
    }
    svg {
      margin-left: -15.5px;
      margin-right: -15.5px;
    }
    .user-name {
      color: #9C0C27;
      font-size: 50px
    }
  </style>
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
@stop