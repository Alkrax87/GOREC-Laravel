<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
</head>
<body>
  <h1>Register</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="nombreUsuario">First Name</label>
            <input type="text" name="nombreUsuario" id="nombreUsuario" value="{{ old('nombreUsuario') }}" required>
        </div>
        <div>
            <label for="apellidoUsuario">Last Name</label>
            <input type="text" name="apellidoUsuario" id="apellidoUsuario" value="{{ old('apellidoUsuario') }}" required>
        </div>
        <div>
            <label for="usuarioUsuario">Username</label>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div>
            <label for="contrasenaUsuario">Password</label>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div>
            <label for="contrasenaUsuario_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>
        <div>
            <label for="tipoUsuario">User Type</label>
            <input type="text" name="tipoUsuario" id="tipoUsuario" value="{{ old('tipoUsuario') }}">
        </div>
        <div>
            <label for="profesionUsuario">Profession</label>
            <input type="text" name="profesionUsuario" id="profesionUsuario" value="{{ old('profesionUsuario') }}">
        </div>
        <div>
            <label for="especialidadUsuario">Specialty</label>
            <input type="text" name="especialidadUsuario" id="especialidadUsuario" value="{{ old('especialidadUsuario') }}">
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>