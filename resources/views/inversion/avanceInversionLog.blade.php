@extends('adminlte::page')

@section('title', 'Grafico Inversion')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1><i class="fas fa-users-cog"></i> Grafico de Registro de cambios "{{ $inversion->nombreInversion }}"</h1>
  <a href="{{ route('inversion.index') }}" class="btn btn-primary mx-1">
    <i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver
  </a>
</div>
 
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <div>
          <canvas id="lineChart{{$inversion->idInversion}}"></canvas>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Obtener datos del avance y fechas desde el backend
            const fechas{{$inversion->idInversion}} = @json($avancelogs->pluck('fechaCambioAvanceInversion'));
            const valores{{$inversion->idInversion}} = @json($avancelogs->pluck('avanceInversionValor'));

            // Renderizar el gráfico
            const ctx{{$inversion->idInversion}} = document.getElementById('lineChart{{$inversion->idInversion}}').getContext('2d');
            new Chart(ctx{{$inversion->idInversion}}, {
              type: 'line',
              data: {
                labels: fechas{{$inversion->idInversion}},
                datasets: [{
                  label: 'Avance',
                  data: valores{{$inversion->idInversion}},
                  borderColor: 'rgb(156, 12, 39)',
                  backgroundColor: 'rgba(156, 12, 39, 0.2)',
                  fill: true,
                  tension: 0.4,
                  pointStyle: 'circle',
                  pointRadius: 8,
                  pointHoverRadius: 10
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true,
                    max: 100
                  }
                }
              }
            });
          });
        </script>
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
