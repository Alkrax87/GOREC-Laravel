@extends('adminlte::page')

@section('title', 'Especialidad')

@section('content_header')
  <h1><i class="fas fa-briefcase"></i> Actividades "{{ $especialidad->nombreEspecialidad }}"</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <!-- Agregar -->
          <button class="btn btn-success mb-4" data-toggle="modal"
            data-target="#ModalCreateFase{{ $especialidad->idEspecialidad }}">
            <i class="fas fa-plus"></i>&nbsp;&nbsp; Nueva Actividad
          </button>
          <!-- Tabla -->
          <div class="table-responsive">
            <table class="table table-striped w-100">
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
                          aria-valuenow="{{ $fase->porcentajeAvanceFase }}" aria-valuemin="0"
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
                        <div
                          class="progress-bar progress-bar-striped
                            @if ($fase->avanceTotalFase < $fase->porcentajeAvanceFase * 0.25) bg-danger
                            @elseif(
                                $fase->avanceTotalFase >= $fase->porcentajeAvanceFase * 0.25 &&
                                    $fase->avanceTotalFase < $fase->porcentajeAvanceFase * 0.75)
                                bg-warning
                            @elseif(
                                $fase->avanceTotalFase >= $fase->porcentajeAvanceFase * 0.75 &&
                                    $fase->avanceTotalFase < $fase->porcentajeAvanceFase)
                                bg-success
                            @else
                                bg-info @endif"
                          role="progressbar" aria-valuenow="{{ $fase->avanceTotalFase }}" aria-valuemin="0"
                          aria-valuemax="{{ $fase->porcentajeAvanceFase }}" style="width: {{ $fase->avanceTotalFase }}%">
                        </div>
                      </div>
                      <div class="w-100 text-center">
                        <small>{{ $fase->avanceTotalFase }}% Completado</small>
                      </div>
                    </td>
                    <td class="text-nowrap text-center">
                      <a class="btn bg-navy color-palette" data-toggle="modal"
                        data-target="#ModalSubFase{{ $fase->idFase }}"><i class="fa fa-tasks"></i> Sub Actividades</a>
                    </td>
                    <td class="text-center" style="white-space: nowrap">
                      <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEditFase{{ $fase->idFase }}"><i
                          class="fas fa-edit"></i></a>
                      <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteFase{{ $fase->idFase }}"><i
                          class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @include('especialidad.fase.create', ['especialidad' => $especialidad])
          </div>
        </div>
      </div>
      @foreach ($fases as $fase)
        @include('especialidad.subfase.index', [
            'fase' => $fase,
            'subfases' => $subfases->where('idFase', $fase->idFase),
        ])
        @include('especialidad.fase.delete', ['fase' => $fase])
        @include('especialidad.fase.edit', ['fase' => $fase])
      @endforeach
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@stop
