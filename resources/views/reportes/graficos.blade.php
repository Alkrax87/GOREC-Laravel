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
              <!-- Select para inversiones -->
              <div class="form-group">
                <label for="inversionSelect">Selecciona Inversión</label>
                <select id="inversionSelect" class="form-control">
                    <option value="">Seleccione una inversión</option>
                    @foreach($inversiones as $inversion)
                        <option value="{{ $inversion->idInversion }}">{{ $inversion->nombreCortoInversion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select para especialidades -->
            <div class="form-group">
                <label for="especialidadSelect">Selecciona Especialidad</label>
                <select id="especialidadSelect" class="form-control">
                    <option value="">Seleccione una especialidad</option>
                </select>
            </div>
              <!-- Select para Fases -->
            <div class="form-group">
              <label for="faseSelect">Selecciona Fase</label>
              <select id="faseSelect" class="form-control">
                  <option value="">Seleccione una fase</option>
              </select>
            </div>
          
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Especialidades</h3>
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

                <!-- INVERSIONES knob-->
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
                        <h3 class="card-title">Sub Actividades</h3>
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
                        <h3 class="card-title">Actividades</h3>
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
        <button id="generate-pdf" class="btn btn-primary">Generar PDF</button>
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
      // Crear el Line chart
      
    // Crear el BAR CHART
    });
    //GENERAR PDF DE LOS CHARTJS
    document.getElementById('generate-pdf').addEventListener('click', function() {
            const lineChart = document.getElementById('lineChart');
            const donutChart = document.getElementById('donutChart');

            const lineChartImage = lineChart.toDataURL('image/png');
            const donutChartImage = donutChart.toDataURL('image/png');

            const data = {
                lineChartImage: lineChartImage,
                donutChartImage: donutChartImage,
                _token: '{{ csrf_token() }}'
            };

            fetch('{{ route("reportes.graficos") }}', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => response.blob())
              .then(blob => {
                  const url = window.URL.createObjectURL(blob);
                  const a = document.createElement('a');
                  a.style.display = 'none';
                  a.href = url;
                  a.download = 'report.pdf';
                  document.body.appendChild(a);
                  a.click();
                  window.URL.revokeObjectURL(url);
              })
              .catch(error => console.error('Error:', error));
        });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
    const inversionSelect = document.getElementById('inversionSelect');
    const especialidadSelect = document.getElementById('especialidadSelect');
    const faseSelect = document.getElementById('faseSelect');
    let donutChart;
    let barChart;
    let lineChart;

    function updateDonutChart(data) {
        const ctxDonut = document.getElementById('donutChart').getContext('2d');

        if (donutChart) {
            donutChart.destroy();
        }

        donutChart = new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.nombreEspecialidad),
                datasets: [{
                    data: data.map(item => item.avanceTotalEspecialidad),
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
                    }
                },
                elements: {
                    arc: {
                        borderWidth: 1,
                        offset: 10
                    }
                }
            }
        });
    }

    function updateBarChart(data) {
        const ctxBar = document.getElementById('barChart').getContext('2d');

        if (barChart) {
            barChart.destroy();
        }

        barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: data.map(item => item.nombreFase),
                datasets: [{
                    label: 'Avance Total Fase',
                    data: data.map(item => item.avanceTotalFase),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    function updateLineChart(data){
      const ctxLine = document.getElementById('lineChart').getContext('2d');
      if (lineChart) {
          lineChart.destroy();
        }
        lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
          labels: data.map(item => item.fechaInicioSubfase),
          datasets: [{
            label: 'Avance Real Total SubFase',
            data: data.map(item => item.avanceRealTotalSubFase),
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
    }
    inversionSelect.addEventListener('change', function() {
        const inversionId = this.value;

        console.log('Inversión seleccionada:', inversionId);

        especialidadSelect.innerHTML = '<option value="">Seleccione una especialidad</option>';
        faseSelect.innerHTML = '<option value="">Seleccione una fase</option>';

        if (inversionId) {
            fetch(`/reportes/inversion/${inversionId}/especialidad`)
                .then(response => response.json())
                .then(data => {
                    console.log('Datos recibidos:', data);

                    data.forEach(especialidad => {
                        const option = document.createElement('option');
                        option.value = especialidad.idEspecialidad;
                        option.textContent = especialidad.nombreEspecialidad;
                        especialidadSelect.appendChild(option);
                    });

                    updateDonutChart(data);
                })
                .catch(error => console.error('Error:', error));
        }
    });

    especialidadSelect.addEventListener('change', function() {
        const especialidadId = this.value;

        console.log('Especialidad seleccionada:', especialidadId);

        faseSelect.innerHTML = '<option value="">Seleccione una fase</option>';

        if (especialidadId) {
            fetch(`/reportes/especialidad/${especialidadId}/fase`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fases recibidas:', data);

                    data.forEach(fase => {
                        const option = document.createElement('option');
                        option.value = fase.idFase;
                        option.textContent = fase.nombreFase;
                        faseSelect.appendChild(option);
                    });
                   
                    updateBarChart(data);

                })
                .catch(error => console.error('Error:', error));
        }
    });
    faseSelect.addEventListener('change', function(){
      const faseId = this.value;
      console.log('fase seleccionada:', faseId);
      
      if (faseId) {
            fetch(`/reportes/fase/${faseId}/subfase`)
                .then(response => response.json())
                .then(data => {
                    console.log('Subfases recibidas:', data);

                    updateLineChart(data);
                })
                .catch(error => console.error('Error:', error));
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