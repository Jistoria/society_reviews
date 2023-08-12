@extends('layouts.templade')

@section('title','Registro')

@section('content')
<h1>Registro</h1>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        @error('password_confirmation')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="color">Color favorito:</label>
        <input type="color" name="color" id="color" value="{{ old('color') }}">
        @error('color')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <button type="submit">Registrarse</button>
    </div>
</form>
@endsection
