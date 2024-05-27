@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-start">
                    <h2>Inversiones</h2>
                </div>
                <div class="float-end py-3">
                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#ModalCreate"> Crear nueva inversión</a>
                </div>
            </div>
        </div>
        <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table" id="prueba">
        <tr class="table-danger">
            <th>ID</th>
            <th>CUI</th>
            <th>Nombre Inversion</th>
            <th>Nombre Corto Inversion</th>
            <th>Nivel Inversion</th>
            <th>Provincia </th>
            <th>Distrito </th>
            <th>Funcion Inversion</th>
            <th>Fecha Inicio </th>
            <th>Fecha Final </th>
            <th>Acciones </th>
        </tr>
        @foreach ($inversiones as $inversion)
        <tr >
            <td>{{ $inversion->idInversion}}</td>
            <td>{{ $inversion->cuiInversion}}</td>
            <td>{{ $inversion->nombreInversion}}</td>
            <td>{{ $inversion->nombreCortoInversion}}</td>
            <td>{{ $inversion->nivelInversion}}</td>
            <td>{{ $inversion->provinciaInversion}}</td>
            <td>{{ $inversion->distritoInversion}}</td>
            <td>{{ $inversion->funcionInversion}}</td>
            <td>{{ $inversion->fechaInicioInversion}}</td>
            <td>{{ $inversion->fechaFinalInversion}}</td>
            <td>
                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalDelete{{$inversion->idInversion}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </a> 
                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#ModalShow{{$inversion->idInversion}}">
                    <i class="fas fa-eye"></i> Mostrar
                </a>
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#ModalEdit{{$inversion->idInversion}}">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </td>
           
            @include('Inversion.delete')
            @include('Inversion.edit')
            @include('Inversion.show')
        </tr>
        @endforeach
    </table>
    @include('Inversion.create')
    {!! $inversiones->links() !!}
</div>
@stop
      
@section('css')
    {{-- Add here extra stylesheets --}}
   {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
   {{--  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"> --}}
@stop

@section('js')
 {{--  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>--}}
  {{-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>--}}
  {{-- <script>
    $('#prueba').DataTable();
  {{-- </script>--}}
@stop