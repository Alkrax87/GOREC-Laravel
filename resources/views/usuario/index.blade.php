@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-end py-3">
                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#ModalCreate"> Crear nuevo Usuario</a>
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
            <th>#</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>USUARIO</th>
            <th>CONTRASEÑA</th>
            <th>PROFESION</th>
            <th>ESPECIALIDAD</th>
        </tr>
        @foreach ($users as $usuario)
        <tr >
            <td>{{ $usuario->idUser}}</td>
            <td>{{ $usuario->nombreUsuarios}}</td>
            <td>{{ $usuario->apellidoUsuarios}}</td>
            <td>{{ $usuario->email}}</td>
            <td>{{ $usuario->password}}</td>
            <td>{{ $usuario->profesionUsuarios}}</td>
            <td>{{ $usuario->especialidadUsuarios}}</td>
            <td>
                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalDelete{{$usuario->idUser}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </a> 
                 <a class="btn btn-info" href="#" data-toggle="modal" data-target="#ModalShow{{$usuario->idUser}}">
                    <i class="fas fa-eye"></i> Mostrar
                </a>
                 <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#ModalEdit{{$usuario->idUser}}">
                    <i class="fas fa-edit"></i> Editar
                
            </td>
           
            @include('Usuario.delete')
            @include('usuario.edit')
            @include('usuario.show')
           
        </tr>
        @endforeach
    </table>
    @include('usuario.create')
    {!! $users->links() !!}
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