
<div class="modal fade" id="ModalFase{{ $especialidad->idEspecialidad }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class="fas fa-briefcase"></i> Actividades {{ $especialidad->nombreEspecialidad }}</h3>
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
                <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreateFase{{ $especialidad->idEspecialidad  }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Nueva Actividad</button>
                <!-- Tabla -->
                <div class="table-responsive">
                  <table id="profesionalesTable" class="table table-striped w-100">
                    <thead class="table-header">
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-left">Actividad</th>
                        <th class="text-center text-nowrap">Porcentaje de Actividad</th>
                        <th class="text-center text-nowrap">Porcentaje de Avance</th>
                        <th class="text-center">Sub Actividad</th>
                        <th class="text-center">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($fases as $fase)
                        <tr>
                            <td class="text-left">{{ $loop->index + 1 }}</td>
                            <td class="text-left">{{ $fase->nombreFase }}</td>
                            <td class="project_progress text-nowrap">
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
                            </td>
                            <td class="project_progress text-nowrap">
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
                            </td>
                            <td class="text-nowrap text-center">
                              <a class="btn bg-navy color-palette" data-toggle="modal" data-target="#ModalSubFase{{ $fase->idFase }}"><i class="fa fa-tasks"></i> Sub Actividades</a>
                            </td>
                            <td class="text-center" style="white-space: nowrap">
                              <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEditFase{{ $fase->idFase }}"><i class="fas fa-edit"></i></a>
                              <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteFase{{ $fase->idFase }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @include('especialidad.fase.create', ['especialidad' => $especialidad])
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
  @foreach ($fases as $fase)
    @include('especialidad.subfase.index', [
      'fase' => $fase,
      'subfases' => $subfases->where('idFase', $fase->idFase)
      ])
    @include('especialidad.fase.delete', ['fase' => $fase])
    @include('especialidad.fase.edit', ['fase' => $fase])
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
   