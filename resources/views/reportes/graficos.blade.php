@extends('adminlte::page')

@section('title', 'Home')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reportes</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>

                <!-- INVERSIONES -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Inversiones</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="knob-container">
                            @foreach($inversiones as $inversion)
                                <div class="knob-item">
                                    <input type="text" class="knob" value="{{ $inversion->avanceInversion }}" data-width="100" data-height="100" data-fgColor="#3c8dbc" readonly>
                                    <div>{{ $inversion->nombreCortoInversion }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@stop

@section('css')

  <style>
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
      width: 100%;
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
  <style>
    .knob-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .knob-item {
        text-align: center;
        margin: 20px;
    }
</style>
@stop

@section('js')
<script>
    $(function() {
      $(".knob").knob();
    });
  </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
      // Datos para el Line chart
      const subfases = @json($subfases);

      const fechas = subfases.map(subfase => subfase.fechaInicioSubfase);
      const avances = subfases.map(subfase => subfase.avanceRealTotalSubFase);

      // Crear el Line chart
      const ctxArea = document.getElementById('lineChart').getContext('2d');
      const areaChart = new Chart(ctxArea, {
        type: 'line',
        data: {
          labels: fechas,
          datasets: [{
            label: 'Avance Real Total SubFase',
            data: avances,
            borderColor: 'rgba(60,141,188,0.8)',
            backgroundColor: 'rgba(60,141,188,0.4)',
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              type: 'time',
              time: {
                unit: 'day',
                tooltipFormat: 'dd/MM/yyyy',
                displayFormats: {
                  day: 'dd/MM/yyyy'
                }
              },
              title: {
                display: true,
                text: 'Fecha Inicio Subfase'
              }
            },
            y: {
              title: {
                display: true,
                text: 'Avance Real Total SubFase'
              }
            }
          }
        }
      });
      //DONUT CHART
      // Datos para el donut chart
      const especialidades = @json($especialidades);

      const especialidadNombres = especialidades.map(especialidad => especialidad.nombreEspecialidad);
      const avanceTotalEspecialidades = especialidades.map(especialidad => especialidad.avanceTotalEspecialidad);

      // Crear el donut chart
      const ctxDonut = document.getElementById('donutChart').getContext('2d');
      const donutChart = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: especialidadNombres,
          datasets: [{
            label: 'Avance Total Especialidad',
            data: avanceTotalEspecialidades,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            tooltip: {
              enabled: true
            },
            legend: {
              display: true
            },
            datalabels: {
              formatter: (value, ctx) => {
                return ctx.chart.data.labels[ctx.dataIndex];
              }
            }
          },
          elements: {
            arc: {
              borderWidth: 1,
              offset: 10 // Offset para separar los segmentos
            }
          }
        }
      });
    // Crear el BAR CHART
    const ctxBar = document.getElementById('barChart').getContext('2d');
      const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: fechas,
          datasets: [{
            label: 'Avance Real Total SubFase',
            data: avances,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              type: 'time',
              time: {
                unit: 'day',
                tooltipFormat: 'dd/MM/yyyy',
                displayFormats: {
                  day: 'dd/MM/yyyy'
                }
              },
              title: {
                display: true,
                text: 'Fecha Inicio Subfase'
              }
            },
            y: {
              title: {
                display: true,
                text: 'Avance Real Total SubFase'
              }
            }
          }
        }
      });
    });
  </script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
   <script src="https://cdn.rawgit.com/aterrien/jQuery-Knob/master/js/jquery.knob.js"></script>
<script>
    console.log(Chart.version);
</script>
<!-- ChartJS -->


<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop