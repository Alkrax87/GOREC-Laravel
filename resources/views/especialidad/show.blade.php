<!-- Modal -->
<div class="modal fade" id="ModalShow{{ $especialidad->idEspecialidad }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fas fa-users-cog"></i> Detalle Especialidad</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>{{ $especialidad->nombreEspecialidad }}</h1>
              <ul class="list-group">
                @if ($especialidad->fases && $especialidad->fases->count() > 0)
                  @foreach ($especialidad->fases as $fase)
                    <li class="list-group-item">
                      <p style="display: flex; gap: 20px;">
                        <span>Actividad</span>
                        <span>Porcentaje Programado</span>
                        <span>Avance (%)</span>
                      </p>
                      <p style="display: flex; gap: 135px;">
                        <span>{{ $fase->nombreFase }}</span>
                        <span>{{ $fase->porcentajeAvanceFase }}</span>
                        <span>{{ $fase->avanceTotalFase }}</span>
                      </p>
                      <ul class="list-group">
                          <p style="display: flex; gap: 20px;">
                            <span>Sub Actividad</span>
                            <span>Fecha Inicio</span>
                            <span>Fecha Final</span>
                            <span>Avance Programado</span>
                            <span>Avance (%)</span>
                          </p>
                          @if ($fase->subfases && $fase->subfases->count() > 0)
                            @foreach ($fase->subfases as $subfase)
                              <li class="list-group-item">
                                <p style="display: flex; gap: 80px;">
                                  <span>{{ $subfase->nombreSubfase}}</span>
                                  <span>{{ $subfase->fechaInicioSubfase}}</span>
                                  <span>{{ $subfase->fechaFinalSubfase}}</span>
                                  <span>{{ $subfase->porcentajeAvanceProgramadoSubFase}}</span>
                                  <span>{{ $subfase->avanceRealTotalSubFase}}</span>
                                </p>
                              </li>
                            @endforeach
                          @else
                            <li class="list-group-item">No hay subfases disponibles.</li>
                          @endif
                      </ul>
                    </li>
                  @endforeach
                @else
                  <li class="list-group-item">No hay fases disponibles.</li>
                @endif
              </ul>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>