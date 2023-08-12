@extends('layouts.templade')

@section('title', 'Iniciar Sesión como Administrador')

@section('content')
    <h1>Iniciar Sesión como Administrador</h1>
    <form method="POST" action="{{ route('admin_login') }}">
        @csrf
        <div>
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>
@endsection
