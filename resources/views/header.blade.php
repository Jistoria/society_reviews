<header>
    <nav>
        <ul>
            <li><a href="/">Inicio</a></li>
            @guest
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}">Registrarse</a></li>
                {{-- forma barata de esconder esto --}}
                @auth(!('admin'))
                <li><a href="{{ route('login_admin_view') }}">login_admin</a></li>
                @endauth
            @endguest
            @auth
                    <li><a href="{{ route('logout') }}">Logout</a></li>
            @endauth
            <li><a href="{{route('create_admin')}}">crear un admin</a></li>
        </ul>
    </nav>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
</header>
