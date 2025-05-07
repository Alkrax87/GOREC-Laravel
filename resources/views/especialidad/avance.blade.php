@extends('adminlte::page')

@section('title', 'Registros de Cambios')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1><i class="fas fa-chart-line"></i> Registro de cambios "{{ $especialidad->nombreEspecialidad }}"</h1>
  <a href="{{ route('especialidad.index') }}" class="btn btn-primary mx-1">
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
            <canvas id="lineChart"></canvas>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
              // Asignar variables para las fechas y valores del gráfico
              const fechas = @json($logs->pluck('fechaCambioAvanceEspecialidad'));
              const valores = @json($logs->pluck('avanceEspecialidadValor'));

              // Obtener el contexto del canvas
              const ctx = document.getElementById('lineChart').getContext('2d');

              // Crear el gráfico
              const lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: fechas,
                  datasets: [{
                    label: 'Avance %',
                    data: valores,
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

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@stop
