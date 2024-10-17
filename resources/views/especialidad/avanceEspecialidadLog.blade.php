<div class="modal fade text-left" id="ModalAvanceEspecialidadLog{{$especialidad->idEspecialidad}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-chart-line"></i> Registro de cambios de avance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-center">{{ $especialidad->nombreEspecialidad }}</h5>
        <div>
          <canvas id="lineChart{{$especialidad->idEspecialidad}}"></canvas>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Asigna variables únicas por cada modal
            const fechas{{$especialidad->idEspecialidad}} = @json($logs->pluck('fechaCambioAvanceEspecialidad'));
            const valores{{$especialidad->idEspecialidad}} = @json($logs->pluck('avanceEspecialidadValor'));

            // Almacenar referencia del gráfico
            let lineChart{{$especialidad->idEspecialidad}};

            // Renderizar el gráfico solo cuando se abre el modal
            $('#ModalAvanceEspecialidadLog{{$especialidad->idEspecialidad}}').on('shown.bs.modal', function () {
              const ctx{{$especialidad->idEspecialidad}} = document.getElementById('lineChart{{$especialidad->idEspecialidad}}').getContext('2d');

              // Si ya existe un gráfico, destruirlo antes de crear uno nuevo
              if (lineChart{{$especialidad->idEspecialidad}}) {
                lineChart{{$especialidad->idEspecialidad}}.destroy();
              }

              // Crear un nuevo gráfico
              lineChart{{$especialidad->idEspecialidad}} = new Chart(ctx{{$especialidad->idEspecialidad}}, {
                type: 'line',
                data: {
                  labels: fechas{{$especialidad->idEspecialidad}},
                  datasets: [{
                    label: 'Avance',
                    data: valores{{$especialidad->idEspecialidad}},
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

            // Destruir el gráfico cuando se cierra el modal
            $('#ModalAvanceEspecialidadLog{{$especialidad->idEspecialidad}}').on('hidden.bs.modal', function () {
              if (lineChart{{$especialidad->idEspecialidad}}) {
                lineChart{{$especialidad->idEspecialidad}}.destroy();
              }
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>