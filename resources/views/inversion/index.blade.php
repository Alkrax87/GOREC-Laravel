@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>INVERSIONES</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-start py-3">
                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#ModalCreate"> Crear nueva inversión</a>
                </div>
            </div>
        </div>
        
        <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        <table id="prueba" class="table table-striped" style="width:100%">
            <thead>
                <tr class="table-dark">
                
                    <th>CUI</th>
                    <th>NOMBRE INVERSION</th>
                    <th>NOMBRE CORTO INVERSION</th>
                    <th>NIVEL INVERSION</th>
                    <th>PROVINCIA</th>
                    <th>DISTRITO </th>
                    <th>FUNCION DE INVERSION</th>
                    <th>PRESUPUESTO FORMULACION</th>
                    <th>PRESUPUESTO EJECUCION </th>
                    <th>MODALIDAD DE EJECUCION </th>
                    <th>ESTADO DE INVERSION</th>
                    <th>FECHA INCIO</th>
                    <th>FECHA FINAL</th>
                    <th>ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inversiones as $inversion)
                <tr>
                    
                    <td>{{ $inversion->cuiInversion}}</td>
                    <td>{{ $inversion->nombreInversion}}</td>
                    <td>{{ $inversion->nombreCortoInversion}}</td>
                    <td>{{ $inversion->nivelInversion}}</td>
                    <td>{{ $inversion->provinciaInversion}}</td>
                    <td>{{ $inversion->distritoInversion}}</td>
                    <td>{{ $inversion->funcionInversion}}</td>
                    <td>{{ $inversion->presupuestoFormulacionInversion}}</td>
                    <td>{{ $inversion->presupuestoEjecucionfuncionInversion}}</td>
                    <td>{{ $inversion->modalidadEjecucionInversion}}</td>
                    <td>{{ $inversion->estadoInversion}}</td>
                    <td>{{ $inversion->fechaInicioInversion}}</td>
                    <td>{{ $inversion->fechaFinalInversion}}</td>
                    <td>
                        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalDelete{{$inversion->idInversion}}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <a class="btn btn-info" href="#" data-toggle="modal" data-target="#ModalShow{{$inversion->idInversion}}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#ModalEdit{{$inversion->idInversion}}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @include('Inversion.create')
       
    </div>
</div>

@foreach ($inversiones as $inversion)
    @include('Inversion.delete', ['inversion' => $inversion])
    @include('Inversion.edit', ['inversion' => $inversion])
    @include('Inversion.show', ['inversion' => $inversion])
@endforeach
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
@stop

@section('js')
 <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
 <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
 <script src=" https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script> 
<script src=" https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

<script>

new DataTable('#prueba', {
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
    

</script>
@stop