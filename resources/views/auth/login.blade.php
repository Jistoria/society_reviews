@extends('layouts.templade')

@section('title','Login')

@section('content')
<h1>Iniciar sesión</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="name">Nombre de usuario:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
    </div>
    @error('login')
    <p>{{ $message }}</p>
    @enderror
    <div>
        <button type="submit">Iniciar sesión</button>
    </div>
</form>
@endsection
