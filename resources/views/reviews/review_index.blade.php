@extends('layouts.templade')
@section('title', $review->titulo)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">{{ $review->titulo }}</h1>
                        <img src="{{ $review->imagen }}" class="card-img-top" alt="Imagen de la reseña">
                        <p class="card-text">{{ $review->sinopsis }}</p>
                        <p class="card-text">Calificación: {{ $review->grade_master() ?? 'N/A' }}</p>
                        <p class="card-text">Etiquetas:
                            @foreach ($review->tags as $tag)
                                <span style="color:brown" class="badge badge-primary">{{ $tag->name_tag }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Vista de la media de calificaciones --}}
        <h4>
            Tiene una media de calificacion : {{$calificacion_final}}
        </h4>

    {{-- Calificar review --}}
    @auth
        <form action="{{route('grade.review',$review->slug)}}" method="post">
            @csrf
            <div class="form-group">
                <label>Calificación Maestra:</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @foreach ($grades as $grade)
                        <label class="btn btn-secondary @if (isset($reviewGrades) && $reviewGrades->contains('id_grade', $grade->id_grade)) active @endif">
                            <input type="radio" name="grade" value="{{ $grade->letter }}"
                                @if (isset($reviewGrades) && $reviewGrades->contains('id_grade', $grade->id_grade)) checked @endif>
                            {{ $grade->letter }} - {{ $grade->value }}
                        </label>
                    @endforeach
                </div>
                <input type="hidden" name="id_user" id="" value="{{auth()->user()->id_user}}">
            </div>
            <button type="submit" class="btn btn-primary">Calificar</button>
        </form>
    @endauth


        <!-- Caja de comentarios -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comentarios</div>
                    <div class="card-body">
                        @forelse ($review->comments as $comment)
                            <div class="mb-3">
                                <div class="circle" style="background-color: {{ $comment->user->color }}"></div>
                                <strong>{{ $comment->user->name }}</strong>
                                <p>{{ $comment->contenido }}</p>
                            </div>
                        @empty
                            <p>No hay comentarios aún.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    @auth
        <!-- Formulario para agregar comentario -->
        @error('contenido')
        <p>{{ $message }}</p>
        @enderror
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agregar Comentario</div>
                    <div class="card-body">
                        <form action="{{route('new.comment')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id_user" id="" value="{{auth()->user()->id_user}}">
                                <input type="hidden" name="id_review" id="" value="{{$review->id_review}}">
                                <textarea class="form-control" name="contenido" rows="4" placeholder="Escribe tu comentario aquí"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para dejar un comentario.</p>
    @endauth

@endsection




