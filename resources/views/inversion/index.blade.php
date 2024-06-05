@extends('adminlte::page')

@section('title', 'Inversion')

@section('content_header')
  <h1>Inversiones</h1>
@stop

@section('content')
  <div class="container-fluid">
    <div class="row">
      <!-- Agregar -->
      <div class="col-12 py-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#ModalCreate"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Inversión</button>
      </div>
      <!-- Tabla y alert -->
      <div class="col-12">

        <!-- Alert -->
        @if ($message = Session::get('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
          </div>
        @endif

        <!-- Tabla -->
        <div class="table-responsive">
          <table id="segmentosTable" class="table table-bordered table-striped">
            <thead class="table-header">
              <tr>
                <th>#</th>
                <th>CUI</th>
                <th>Nombre</th>
                <th>Nombre Corto</th>
                <th>Nivel</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Función</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Presupuesto Formulacióin</th>
                <th>Presupuesto Ejecución</th>
                <th>Modalidad Ejecución</th>
                <th>Estado</th>
                <th class="text-center">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($inversiones as $inversion)
                <tr>
                  <td class="text-left">{{ $loop->index + 1 }}</td>
                  <td>{{ $inversion->cuiInversion}}</td>
                  <td>{{ $inversion->nombreInversion}}</td>
                  <td>{{ $inversion->nombreCortoInversion}}</td>
                  <td>{{ $inversion->nivelInversion}}</td>
                  <td>{{ $inversion->provinciaInversion}}</td>
                  <td>{{ $inversion->distritoInversion}}</td>
                  <td>{{ $inversion->funcionInversion}}</td>
                  <td>{{ $inversion->fechaInicioInversion}}</td>
                  <td>{{ $inversion->fechaFinalInversion}}</td>
                  <td>{{ $inversion->presupuestoFormulacionInversion}}</td>
                  <td>{{ $inversion->presupuestoEjecucionfuncionInversion}}</td>
                  <td>{{ $inversion->modalidadEjecucionInversion}}</td>
                  <td>{{ $inversion->estadoInversion}}</td>
                  <td class="text-center" style="white-space: nowrap">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalShow{{$inversion->idInversion}}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit{{$inversion->idInversion}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$inversion->idInversion}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @include('inversion.create')
        </div>
      </div>
    </div>
  </div>
  @foreach ($inversiones as $inversion)
    @include('inversion.delete', ['inversion' => $inversion])
    @include('inversion.edit', ['inversion' => $inversion])
    @include('inversion.show', ['inversion' => $inversion])
  @endforeach
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#segmentosTable').DataTable({
        responsive: true,
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando página _PAGE_ de _PAGES_",
          infoEmpty: "No hay registros disponibles",
          infoFiltered: "(filtrado de _MAX_ registros totales)",
          paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
          }
        }
      });
    });
  </script>
@stop

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