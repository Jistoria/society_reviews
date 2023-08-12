@extends('layouts.templade')

@section('title', 'Inicio')
@section('content')
    <h1>Bienvenido a mi sitio</h1>
    <p>Esta es la página de inicio</p>
    <div class="container">
        <h1>Buscar Reseñas</h1>
        <form action="{{ route('reviews.search') }}" method="GET">
            <div class="form-group">
                <label for="search">Buscar por título:</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ old('search') }}">
            </div>
            <div class="form-group">
                <label for="tags">Etiquetas:</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id_tag }}">{{ $tag->name_tag }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="grades">Calificación:</label>
                <select name="grade" id="grades" class="form-control" >
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->letter }}">{{ $grade->letter }}: {{ $grade->value }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        {{-- Vista de la paginacion --}}
        <h1>Reseñas</h1>
        <div class="row">
            @forelse ($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h1 class="card-title">{{ $review->titulo }}</h1>
                    <a href="{{route('show.review',$review->slug)}}"> Ver</a>
                    <p class="card-text">{{ $review->sinopsis }}</p>
                    <p class="card-text">Calificacion: {{ $review->grade_master() ?? 'N/A' }}</p>
                    <p class="card-text">Etiquetas:
                        @foreach ($review->tags as $tag)
                            <span style="color:blueviolet" class="badge badge-primary">{{ $tag->name_tag }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
            {{-- nota el empty debe cerrar el nivel del endforelse, cosas de html --}}
        @empty
            <div class="card mb-3">
                <div class="card-body">
                    <h1 class="card-title">No hay reseñas disponibles.</h1>
                </div>
            </div>
        @endforelse

    </div>

@endsection
