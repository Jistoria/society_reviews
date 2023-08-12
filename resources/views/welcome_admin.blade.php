
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('/resources/css/app.css')
</head>
    <title>Panel de Administración</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                {{-- nadie tiene permitido entrar a esta vista pero igual dejo la comprobacion --}}
                @auth('admin')
                    <li><a href="{{ route('logout_admin') }}">Cerrar sesión</a></li>
                @endauth
                <li><a href="{{ route('create_admin') }}">Crear un admin</a></li>
            </ul>
        </nav>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </header>

    <div class="container">
        @auth('admin')
            <h1>Bienvenido, {{ auth('admin')->user()->username }}</h1>
        @endauth

        <!-- Resto del contenido para el panel de administración -->
        <!-- Por ejemplo, aquí puedes mostrar información específica para el administrador -->
          <!-- Botones para ver usuarios y reseñas -->
          <a href="" class="btn btn-primary">Ver Usuarios</a>
          <a href="{{ route('table_reviews') }}" class="btn btn-primary">Ver Reseñas</a>
          <a href="{{ route('create_review_view') }}" class="btn btn-primary">Crear Reseña</a>
          @yield('content','manito presione un boton')
    </div>
     <!-- Importa el script de jQuery (requerido por Bootstrap) -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
