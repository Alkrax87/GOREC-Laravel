@extends('adminlte::page')

@section('title', 'Inversion • Avance')

@section('content_header')
  <div class="d-flex justify-content-between align-items-center">
    <h1><i class="fas fa-chart-line"></i> Grafico de avance de: "{{ $inversion->nombreInversion }}"</h1>
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
          <div class="d-flex justify-content-between">
            <div class="d-flex">
              <h2 class="pr-3"><i class="fas fa-chart-area"></i></h2>
              <button id="toggleView{{$inversion->idInversion}}" class="btn btn-success mb-3">Ver Gráfico Completo</button>
            </div>
            <div class="d-flex align-items-center rounded text-white bg-dark px-3">
              <h4 id="Title" class="mb-0">Gráfico Resumido</h4>
            </div>
          </div>
          <canvas id="lineChart{{$inversion->idInversion}}"></canvas>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('lineChart{{$inversion->idInversion}}').getContext('2d');

      const fullLabels = @json($fullLogs->pluck('fechaCambioAvanceInversion'));
      const fullData = @json($fullLogs->pluck('avanceInversionValor'));

      const resumenLabels = @json($resumenLogs->pluck('fechaCambioAvanceInversion'));
      const resumenData = @json($resumenLogs->pluck('avanceInversionValor'));

      let usandoResumen = true;

      const chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: resumenLabels,
          datasets: [{
            label: 'Avance',
            data: resumenData,
            borderColor: 'rgb(156, 12, 39)',
            // backgroundColor: 'rgba(156, 12, 39, 0.2)',
            fill: true,
            tension: 0.4,
            pointRadius: 6,
            pointHoverRadius: 8,
          }]
        },
        options: {
          responsive: true,
          scales: {
            x: {
              ticks: {
                display: false,
              },
              grid: {
                drawTicks: false,
              }
            },
            y: {
              beginAtZero: true,
              max: 100
            }
          }
        }
      });

      const toggleBtn = document.getElementById('toggleView{{$inversion->idInversion}}');
      toggleBtn.addEventListener('click', function() {
        usandoResumen = !usandoResumen;

        chart.data.labels = usandoResumen ? resumenLabels : fullLabels;
        chart.data.datasets[0].data = usandoResumen ? resumenData : fullData;
        chart.update();

        title = document.getElementById('Title');
        title.innerHTML = usandoResumen ? 'Gráfico Resumido' : 'Gráfico Completo';

        toggleBtn.textContent = usandoResumen ? 'Ver Gráfico Completo' : 'Ver Gráfico Resumido';
      });
    });
  </script>
@endsection