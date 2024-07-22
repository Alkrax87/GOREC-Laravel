<div class="modal fade" id="ModalSubFase{{ $fase->idFase}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fa fa-tasks"></i> Sub Actividades de {{ $fase->nombreFase }}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <!-- Contenido -->
              <div class="col-12">
                <!-- Agregar -->
                <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalSubFaseCreate{{ $fase->idFase }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Nueva Sub Actividad</button>
                <!-- Tabla -->
                <div class="table-responsive">
                  <table id="profesionalesTable" class="table table-striped w-100">
                    <thead class="table-header">
                      <tr>
                        <th>#</th>
                        <th class="text-nowrap">Sub Fase</th>
                        <th class="text-nowrap text-center">Fecha Incio</th>
                        <th class="text-nowrap text-center">Fecha Final</th>
                        <th class="text-nowrap">Total Dias</th>
                        <th class="text-nowrap">Avance Programado</th>
                        <th class="text-nowrap">Avance %</th>
                        <th class="text-nowrap">Avance Usuario</th>
                        <th class="text-center w-25">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($subfases as $subfase)
                      <tr>
                        <td class="text-left">{{ $loop->index + 1 }}</td>
                        <td class="text-left text-nowrap">{{ $subfase->nombreSubfase}}</td>
                        <td class="text-nowrap">
                          <span ><i class="far fa-calendar-alt"></i>&nbsp; {{ $subfase->fechaInicioSubfase}}</span>
                        </td>
                        <td class="text-nowrap">
                          <span ><i class="far fa-calendar-alt"></i>&nbsp; {{ $subfase->fechaFinalSubfase}}</span>
                        </td>
                        <td class="text-center">{{ $subfase->cantidadDiasSubFase}}</td>
                        <td class="project_progress text-nowrap">
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
                        </td>
                        <td class="project_progress text-nowrap">
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
                        </td>
                        <td class="project_progress text-nowrap">
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
                        </td>
                        <td class="text-center" style="white-space: nowrap">
                          @if (Auth::user()->isAdmin)
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#ModalLog{{$subfase->idSubfase}}"><i class="fas fa-list"></i></a>
                          @endif
                          <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEditSubFase{{$subfase->idSubfase}}"><i class="fas fa-edit"></i></a>
                          <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$subfase->idSubfase}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @include('especialidad.subfase.create', ['fase' => $fase ])
                </div>
              </div>
              <div class="col-12 py-2 text-center">
                <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@foreach ($subfases as $subfase)
  @include('especialidad.subfase.avanceLog', [
    'subfase' => $subfase,
    'logs' => $logs->where('idSubfase', $subfase->idSubfase),
  ])
  @include('especialidad.subfase.delete', ['subfase' => $subfase])
  @include('especialidad.subfase.edit', ['subfase' => $subfase])
@endforeach
  <style>
    body {
      background-color: #000;
    }
    section {
      margin-top: 100px;
    }
    /* Others */
    .center-items {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* Card Style */
    .cascading-left {
      margin-left: -50px;
    }
    /* Input Style  */
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
    /* Btn Style  */
    .btn-gorec {
      width: 250px;
      height: 50px;
      background-color: #9C0C27;
      color: #fff;
      border-radius: 50px
    }
    .btn-gorec:hover {
      background-color: #72081f;
      color: #fff;;
    }
    /* Line */
    .line {
      border: 0;
      border-top: 1px solid #72081f;
      margin: 1rem 0;
      width: 50%;
    }
    /* Redirection */
    .login-direction {
      color: #72081f;
      text-decoration: none;
    }
    @media (max-width: 991.98px) {
      .cascading-left {
        margin-left: 0px;
      }
      section {
        margin-top: 0px;
      }
    }
  </style>