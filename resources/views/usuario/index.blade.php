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
      <td>{{ $usuario->idUsuario}}</td>
      <td>{{ $usuario->nombreUsuario}}</td>
      <td>{{ $usuario->apellidoUsuario}}</td>
      <td>{{ $usuario->email}}</td>
      <td>{{ $usuario->password}}</td>
      <td>{{ $usuario->profesionUsuario}}</td>
      <td>{{ $usuario->especialidadUsuario}}</td>
      <td>
        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalDelete{{$usuario->idUsuario}}">
          <i class="fas fa-trash-alt"></i> Eliminar
        </a>
        <a class="btn btn-info" href="#" data-toggle="modal" data-target="#ModalShow{{$usuario->idUsuario}}">
          <i class="fas fa-eye"></i> Mostrar
        </a>
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#ModalEdit{{$usuario->idUsuario}}">
          <i class="fas fa-edit"></i> Editar
        </a>
      </td>
      @include('usuario.delete')
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