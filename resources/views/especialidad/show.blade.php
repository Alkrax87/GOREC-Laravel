<div class="modal fade" id="ModalShow{{ $especialidad->idEspecialidad }}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-users-cog"></i> Detalle Especialidad</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h2>{{ $especialidad->nombreEspecialidad }}</h2>
              <p><i class="fas fa-portrait"></i> <b>Jefe: </b>{{ $especialidad->usuario->nombreUsuario . ' ' . $especialidad->usuario->apellidoUsuario }}</p>
              <div class="row">
                <div class="col-6">
                  <div class="project_progress text-nowrap">
                    <div class="w-100 text-center">
                      <h4>Avance programado</h4>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                        aria-valuenow="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                        aria-valuemin="0"
                        aria-valuemax="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                        style="width: {{ $especialidad->porcentajeAvanceEspecialidad }}%">
                      </div>
                    </div>
                    <div class="w-100 text-center">
                      <small>{{ $especialidad->porcentajeAvanceEspecialidad }}% Especialidad</small>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="project_progress text-nowrap">
                    <div class="w-100 text-center">
                      <h4>Avance %</h4>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped
                        @if($especialidad->avanceTotalEspecialidad < ($especialidad->porcentajeAvanceEspecialidad*0.25))
                            bg-danger
                        @elseif($especialidad->avanceTotalEspecialidad >= ($especialidad->porcentajeAvanceEspecialidad*0.25) && $especialidad->avanceTotalEspecialidad < ($especialidad->porcentajeAvanceEspecialidad*0.75))
                            bg-warning
                        @elseif($especialidad->avanceTotalEspecialidad >= ($especialidad->porcentajeAvanceEspecialidad*0.75) && $especialidad->avanceTotalEspecialidad < $especialidad->porcentajeAvanceEspecialidad)
                            bg-success
                        @else
                            bg-info
                        @endif"
                        role="progressbar"
                        aria-valuenow="{{ $especialidad->avanceTotalEspecialidad }}"
                        aria-valuemin="0"
                        aria-valuemax="{{ $especialidad->porcentajeAvanceEspecialidad }}"
                        style="width: {{$especialidad->avanceTotalEspecialidad }}%">
                      </div>
                    </div>
                    <div class="w-100 text-center">
                      <small>{{ $especialidad->avanceTotalEspecialidad }}% Completado</small>
                    </div>
                  </div>
                </div>
              </div>
              <h4 class="pt-3"><i class="fas fa-briefcase"></i> Actividades</h4>
              @foreach ($especialidad->fases as $fase)
                <div class="card border-danger">
                  <div class="card-header bg-danger">
                    <b><i class="fas fa-briefcase"></i> {{ $fase->nombreFase }}
                  </div>
                  <div class="card-body pb-0">
                    <div class="row">
                      <div class="col-6">
                        <div class="project_progress text-nowrap">
                          <div class="w-100 text-center">
                            <h5>Avance programado</h5>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                              aria-valuenow="{{ $fase->porcentajeAvanceFase }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $fase->porcentajeAvanceFase }}"
                              style="width: {{ $fase->porcentajeAvanceFase }}%">
                            </div>
                          </div>
                          <div class="w-100 text-center">
                            <small>{{ $fase->porcentajeAvanceFase }}% Actividad</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="project_progress text-nowrap">
                          <div class="w-100 text-center">
                            <h5>Avance %</h5>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped
                              @if($fase->avanceTotalFase < ($fase->porcentajeAvanceFase*0.25))
                                  bg-danger
                              @elseif($fase->avanceTotalFase >= ($fase->porcentajeAvanceFase*0.25) && $fase->avanceTotalFase < ($fase->porcentajeAvanceFase*0.75))
                                  bg-warning
                              @elseif($fase->avanceTotalFase >= ($fase->porcentajeAvanceFase*0.75) && $fase->avanceTotalFase < $fase->porcentajeAvanceFase)
                                  bg-success
                              @else
                                  bg-info
                              @endif"
                              role="progressbar"
                              aria-valuenow="{{ $fase->avanceTotalFase }}"
                              aria-valuemin="0"
                              aria-valuemax="{{ $fase->porcentajeAvanceFase }}"
                              style="width: {{$fase->avanceTotalFase }}%">
                            </div>
                          </div>
                          <div class="w-100 text-center">
                            <small>{{ $fase->avanceTotalFase }}% Completado</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="mt-0">
                    <h5><i class="fa fa-tasks"></i> Sub Actividades</h5>
                    @foreach ($fase->subfases as $subfase)
                      <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-6">
                              <i class="fa fa-tasks"></i> {{ $subfase->nombreSubfase }}
                            </div>
                            <div class="col-6">
                              <div class="row">
                                <div class="col-6 text-right">
                                  <span ><i class="far fa-calendar-alt"></i>&nbsp;Inicio: {{ $subfase->fechaInicioSubfase}}</span>
                                </div>
                                <div class="col-6 text-right">
                                  <span ><i class="far fa-calendar-alt"></i>&nbsp;Final: {{ $subfase->fechaFinalSubfase}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <p>Total de dias programados: {{ $subfase->cantidadDiasSubFase }}</p>
                            <div class="col-4">
                              <h5 class="text-center">Porcentaje Programado</h5>
                              <div class="project_progress text-nowrap">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                    aria-valuenow="{{ $subfase->porcentajeAvanceProgramadoSubFase }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $subfase->porcentajeAvanceProgramadoSubFase }}"
                                    style="width: {{ $subfase->porcentajeAvanceProgramadoSubFase }}%">
                                  </div>
                                </div>
                                <div class="w-100 text-center">
                                  <small>{{ $subfase->porcentajeAvanceProgramadoSubFase }}% Sub Actividad</small>
                                </div>
                              </div>
                            </div>
                            <div class="col-4">
                              <h5 class="text-center">Avance Real</h5>
                              <div class="project_progress text-nowrap">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped
                                    @if($subfase->avanceRealTotalSubFase < ($subfase->porcentajeAvanceProgramadoSubFase*0.25))
                                        bg-danger
                                    @elseif($subfase->avanceRealTotalSubFase >= ($subfase->porcentajeAvanceProgramadoSubFase*0.25) && $subfase->avanceRealTotalSubFase < ($subfase->porcentajeAvanceProgramadoSubFase*0.75))
                                        bg-warning
                                    @elseif($subfase->avanceRealTotalSubFase >= ($subfase->porcentajeAvanceProgramadoSubFase*0.75) && $subfase->avanceRealTotalSubFase < $subfase->porcentajeAvanceProgramadoSubFase)
                                        bg-success
                                    @else
                                        bg-info
                                    @endif"
                                    role="progressbar"
                                    aria-valuenow="{{ $subfase->avanceRealTotalSubFase }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $subfase->porcentajeAvanceProgramadoSubFase }}"
                                    style="width: {{$subfase->avanceRealTotalSubFase }}%">
                                  </div>
                                </div>
                                <div class="w-100 text-center">
                                  <small>{{ $subfase->avanceRealTotalSubFase }}% Completado</small>
                                </div>
                              </div>
                            </div>
                            <div class="col-4">
                              <h5 class="text-center">Avance Usuario</h5>
                              <div class="project_progress text-nowrap">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped
                                    @if($subfase->avance_por_usuario_realSubFase < 25)
                                        bg-danger
                                    @elseif($subfase->avance_por_usuario_realSubFase >= 25 && $subfase->avance_por_usuario_realSubFase < 75)
                                        bg-warning
                                    @elseif($subfase->avance_por_usuario_realSubFase >= 75 && $subfase->avance_por_usuario_realSubFase < 100)
                                        bg-success
                                    @else
                                        bg-info
                                    @endif"
                                    role="progressbar"
                                    aria-valuenow="{{ $subfase->avance_por_usuario_realSubFase }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: {{ $subfase->avance_por_usuario_realSubFase }}%">
                                  </div>
                                </div>
                                <div class="w-100 text-center">
                                  <small>{{ $subfase->avance_por_usuario_realSubFase }}% Usuario</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>