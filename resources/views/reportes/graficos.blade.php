@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
  <h1><i class="fas fa-chart-bar"></i> Reportes</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row my-2">
      <div class="col-9">
        <!-- Inversión -->
        <label class="pt-3"><i class="fas fa-clipboard-list"></i>&nbsp;Inversión</label>
        <select id="inversionSelect" class="form-control input-auth">
          <option selected disabled>Seleccione una inversión</option>
          @foreach($inversiones as $inversion)
            <option value="{{ $inversion->idInversion }}">{{ $inversion->nombreCortoInversion }}</option>
          @endforeach
        </select>
        <!-- Especialidad -->
        <label class="pt-3"><i class="fas fa-users-cog"></i>&nbsp;Especialidad</label>
        <select id="especialidadSelect" class="form-control input-auth">
          <option selected disabled>Seleccione una especialidad</option>
        </select>
        <!-- Fase -->
        <label class="pt-3"><i class="fas fa-briefcase"></i>&nbsp;Actividad</label>
        <select id="faseSelect" class="form-control input-auth">
          <option selected disabled>Seleccione una actividad</option>
        </select>
      </div>
      <div class="col-3">
        <!-- Inversion CHART -->
        <div class="card text-white mb-3">
          <div id="chartTitleAvanceInversión" class="card-header text-center bg-dark"></div>
          <div class="card-body text-dark">
            <canvas id="avanceInversionChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Especialidades CHART -->
  <div class="card card-danger">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users-cog"></i>&nbsp;&nbsp;Especialidades</h3>
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
      <div class="container-fluid">
        <div class="row" id="especialidadesChartsContainer"></div>
      </div>
    </div>
  </div>
  <!-- Actividades CHART -->
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Actividades</h3>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Actividades CHART -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Sub Actividades</h3>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <canvas id="barChart2"></canvas>
          </div>
        </div>
      </div>
    </div>

  <button id="generate-pdf" class="btn btn-primary">Generar PDF</button>
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

@section('js')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Definimos el elemento de charts
      let myDoughnutChart;
      let barChart;
      let barChart2;

      let charts = {};

      // Identificamos el titulo y los select
      const titleInversion = document.getElementById('chartTitleAvanceInversión');
      const inversionSelect = document.getElementById('inversionSelect');
      const especialidadSelect = document.getElementById('especialidadSelect');
      const faseSelect = document.getElementById('faseSelect');

      // Manejar el cambio en el selector de inversiones
      inversionSelect.addEventListener('change', function() {
        const inversionId = this.value;

        // Limpiar los selectores de especialidad y fase
        especialidadSelect.innerHTML = '<option value="">Seleccione una especialidad</option>';
        faseSelect.innerHTML = '<option value="">Seleccione una fase</option>';

        // Elimina el grráfico de actividades
        if (barChart) {
          barChart.destroy();
        }
        // Elimina el grráfico de sub actividades
        if (barChart2) {
          barChart2.destroy();
        }

        // Obtenemos la data del nombre y avance de la Inversión
        fetch(`/reportes/inversion/${inversionId}/avanceInversion`).then(response => response.json()).then(avanceInversion => {
          // Asignamos un titulo
          titleInversion.innerHTML = avanceInversion.nombreCortoInversion

          // Actualizar grafico de Avance Inversión (avanceInversionChart)
          const ctx = document.getElementById('avanceInversionChart').getContext('2d');

          let colors;
          if (avanceInversion.avanceInversion < 25) {
            colors = ['#DC3545', '#e0e0e0'];
          } else if (avanceInversion.avanceInversion >= 25 && avanceInversion.avanceInversion < 75){
            colors = ['#FFC107', '#e0e0e0'];
          } else if(avanceInversion.avanceInversion >= 75 && avanceInversion.avanceInversion < 100){
            colors = ['#198754', '#e0e0e0'];
          } else {
            colors = ['#0DCAF0', '#e0e0e0'];
          }

          // Configuración del gráfico
          const chartData = {
            labels: ['Avance ' + avanceInversion.avanceInversion +'%', 'Restante ' + (100 - avanceInversion.avanceInversion) +'%'],
            datasets: [{
              data: [avanceInversion.avanceInversion, 100 - avanceInversion.avanceInversion],
              backgroundColor: colors,
              hoverBackgroundColor: colors
            }]
          };
          const chartOptions = {
            responsive: true,
            plugins: {
              legend: {
                display: true,
                position: 'top',
                labels: {
                  usePointStyle: true,
                }
              }
            }
          };
          // Destruir el gráfico anterior si existe
          if (myDoughnutChart) {
            myDoughnutChart.destroy();
          }
          // Crear el gráfico
          myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: chartOptions
          });
        }).catch(error => console.error('Error:', error));

        // Obtenemos las especialidades de la invesión
        fetch(`/reportes/inversion/${inversionId}/especialidad`).then(response => response.json()).then(especialidades => {
          // Limpiar el contenedor de gráficos de especialidades
          const especialidadesChartsContainer = document.getElementById('especialidadesChartsContainer');
          especialidadesChartsContainer.innerHTML = '';

          let index = 0;

          especialidades.forEach(especialidad => {
            // Actualizamos el select de Especialidad
            const option = document.createElement('option');
            option.value = especialidad.idEspecialidad;
            option.textContent = especialidad.nombreEspecialidad;
            especialidadSelect.appendChild(option);

            // Creamos los nuevos Chart por cada elemento
            const canvasId = `especialidadChart${index + 1}`;
            const container = document.createElement('div');
            container.classList.add('col-lg-3','col-md-4','col-sm-12')
            const canvas = document.createElement('canvas');
            canvas.id = canvasId;
            canvas.classList.add('especialidad-chart');
            container.appendChild(canvas);
            especialidadesChartsContainer.appendChild(container);

            const ctx = canvas.getContext('2d');

            let colors;
            const porcentaje = parseFloat(especialidad.avanceTotalEspecialidad);
            const restante = (especialidad.porcentajeAvanceEspecialidad - porcentaje).toFixed(2);
            if (porcentaje < (especialidad.porcentajeAvanceEspecialidad*0.25)) {
              colors = ['#DC3545', '#e0e0e0'];
            } else if (porcentaje >= (especialidad.porcentajeAvanceEspecialidad*0.25) && porcentaje < (especialidad.porcentajeAvanceEspecialidad*0.75)) {
              colors = ['#FFC107', '#e0e0e0'];
            } else if (porcentaje >= (especialidad.porcentajeAvanceEspecialidad*0.75) && porcentaje < especialidad.porcentajeAvanceEspecialidad) {
              colors = ['#198754', '#e0e0e0'];
            } else {
              colors = ['#0DCAF0', '#e0e0e0'];
            }

            // Configuración del gráfico
            const chartData = {
              labels: [`Avance ${porcentaje}%`, `Restante ${restante}%`],
              datasets: [{
                data: [porcentaje, 100 - porcentaje],
                backgroundColor: colors,
                hoverBackgroundColor: colors
              }]
            };
            const chartOptions = {
              responsive: true,
              plugins: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels:{
                    usePointStyle: true,
                  }
                },
                title: {
                  display: true,
                  text: especialidad.nombreEspecialidad,
                  font: {
                    size: 16,
                    family: 'tahoma'
                  },
                },
                subtitle: {
                  display: true,
                  text: ' (' + especialidad.porcentajeAvanceEspecialidad + '%)',
                  color: 'gray',
                  font: {
                    size: 14,
                    family: 'tahoma',
                    weight: 'normal'
                  },
                  padding: {
                    bottom: 10
                  }
                }
              }
            };
            // Destruir el gráfico anterior si existe
            if (window[`myDoughnutChart${index + 1}`]) {
              window[`myDoughnutChart${index + 1}`].destroy();
            }
            // Crear el gráfico
            window[`myDoughnutChart${index + 1}`] = new Chart(ctx, {
              type: 'doughnut',
              data: chartData,
              options: chartOptions
            });
            index++
          });
        }).catch(error => console.error('Error:', error));
      });

      // Manejar el cambio en el selector de especialidades
      especialidadSelect.addEventListener('change', function() {
        const especialidadId = this.value;
        const especialidadNombre = this.options[this.selectedIndex].text;

        // Limpiar el selector de fases
        faseSelect.innerHTML = '<option value="">Seleccione una fase</option>';

        // Elimina el grráfico de sub actividades
        if (barChart2) {
          barChart2.destroy();
        }

        fetch(`/reportes/especialidad/${especialidadId}/fase`).then(response => response.json()).then(fases => {
          // Poblar el selector de actividades
          fases.forEach(fase => {
            const option = document.createElement('option');
            option.value = fase.idFase;
            option.textContent = fase.nombreFase;
            faseSelect.appendChild(option);
          });

          // Actualizar el gráfico de barras
          const ctx = document.getElementById('barChart').getContext('2d');

          const labels = fases.map(fase => fase.nombreFase);
          const avances = fases.map(fase => parseFloat(fase.avanceTotalFase));
          const totales = fases.map(fase => parseFloat(fase.porcentajeAvanceFase) - parseFloat(fase.avanceTotalFase));
          const maxY = fases.map(fase =>parseFloat(fase.porcentajeAvanceFase))

          // Configuración del gráfico
          const data = {
            labels: labels,
            datasets: [
              {
                label: 'Avance %',
                data: avances,
                backgroundColor: '#198754'
              },
              {
                label: 'Restante %',
                data: totales,
                backgroundColor: '#e0e0e0'
              }
            ]
          };
          const options = {
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
                labels:{
                  usePointStyle: true,
                }
              },
              title: {
                  display: true,
                  text: especialidadNombre,
                  color: 'gray',
                  font: {
                    size: 16,
                    family: 'tahoma'
                  },
                  padding: {
                    bottom: 10
                  }
                }
            },
            scales: {
              x: {
                stacked: true
              },
              y: {
                stacked: true,
                beginAtZero: true,
                max: maxY[0]
              }
            }
          };
          // Destruir el gráfico anterior si existe
          if (barChart) {
            barChart.destroy();
          }
          // Crear el nuevo gráfico
          barChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
          });
        }).catch(error => console.error('Error:', error));
      });

      // Manejar el cambio en el selector de fases
      faseSelect.addEventListener('change', function() {
        const faseId = this.value;
        const faseNombre = this.options[this.selectedIndex].text;

        fetch(`/reportes/fase/${faseId}/subfase`).then(response => response.json()).then(subfases => {
          // Procesar los datos recibidos
          const labels = subfases.map(subfase => subfase.nombreSubfase);
          const avanceProgramado = subfases.map(subfase => parseFloat(subfase.porcentajeAvanceProgramadoSubFase));
          const avanceRealTotal = subfases.map(subfase => parseFloat(subfase.avanceRealTotalSubFase));
          const avanceUsuarioReal = subfases.map(subfase => (parseFloat(subfase.avance_por_usuario_realSubFase)));

          // Configurar los datos del gráfico
          const data = {
            labels: labels,
            datasets: [
              {
                label: 'Avance Programado (%)',
                data: avanceProgramado,
                backgroundColor: 'rgb(33,37,41,0.7)',
                borderColor: 'rgb(33,37,41,1)',
                borderWidth: 1
              },
              {
                label: 'Avance Real Total (%)',
                data: avanceRealTotal,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              },
              {
                label: 'Avance Real por Usuario (%)',
                data: avanceUsuarioReal,
                backgroundColor: 'rgb(25,135,84,0.7)',
                borderColor: 'rgb(25,135,84,1)',
                borderWidth: 1
              }
            ]
          };
          let delayed;
          const options = {
            responsive: true,
            indexAxis: 'y',
            scales: {
              x: {
                beginAtZero: true,
                max: 100
              }
            },
            plugins: {
              legend: {
                display: true,
                position: 'top'
              }
            },
            animation: {
              onComplete: () => {
                delayed = true;
              },
              delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                  delay = context.dataIndex * 300 + context.datasetIndex * 100;
                }
                return delay;
              }
            }
          };
          // Destruir el gráfico anterior si existe
          if (barChart2) {
            barChart2.destroy();
          }
          // Crear el gráfico de barras horizontal
          const ctx = document.getElementById('barChart2').getContext('2d');
          barChart2 = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
          });
        }).catch(error => console.error('Error:', error));
      });

      // Generar PDF de los gráficos de Chart.js
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
    });
  </script>
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
    a {
      text-decoration: none;
    }
    .container-fluid .row {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .input-auth {
      display: block;
      width: 100%;
      height: calc(1.5em + 0.75rem + 2px);
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: all 0.3s ease-in-out;
    }
    .input-auth:focus {
      border-color: #72081f;
      outline: none;
      box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
    }
    .input-autht:focus::placeholder {
      color: transparent;
    }
  </style>
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
@stop