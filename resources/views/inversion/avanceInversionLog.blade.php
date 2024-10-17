<div class="modal fade text-left" id="ModalAvanceInversionLog{{$inversion->idInversion}}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-chart-line"></i> Registro de cambios de avance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-center">{{ $inversion->nombreCortoInversion }}</h5>
        <div>
          <canvas id="lineChart{{$inversion->idInversion}}"></canvas>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Asigna variables únicas por cada modal
            const fechas{{$inversion->idInversion}} = @json($logs->pluck('fechaCambioAvanceInversion'));
            const valores{{$inversion->idInversion}} = @json($logs->pluck('avanceInversionValor'));

            // Almacenar referencia del gráfico
            let lineChart{{$inversion->idInversion}};

            // Renderizar el gráfico solo cuando se abre el modal
            $('#ModalAvanceInversionLog{{$inversion->idInversion}}').on('shown.bs.modal', function () {
              const ctx{{$inversion->idInversion}} = document.getElementById('lineChart{{$inversion->idInversion}}').getContext('2d');

              // Si ya existe un gráfico, destruirlo antes de crear uno nuevo
              if (lineChart{{$inversion->idInversion}}) {
                lineChart{{$inversion->idInversion}}.destroy();
              }

              // Crear un nuevo gráfico
              lineChart{{$inversion->idInversion}} = new Chart(ctx{{$inversion->idInversion}}, {
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

            // Destruir el gráfico cuando se cierra el modal
            $('#ModalAvanceInversionLog{{$inversion->idInversion}}').on('hidden.bs.modal', function () {
              if (lineChart{{$inversion->idInversion}}) {
                lineChart{{$inversion->idInversion}}.destroy();
              }
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>