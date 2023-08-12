@extends('welcome_admin')



@section('content')
@error('contenido')
<p>{{ $message }}</p>
@enderror
    <div class="container">
        <h2>{{ isset($review_edit) ? 'Editar Reseña' : 'Crear Reseña' }}</h2>

        <form action="{{ isset($review_edit) ? route('reviews.update', $review_edit->id_review) : route('reviews.store') }}" method="POST">
            @csrf
            @if(isset($review_edit))
                @method('PUT')
            @endif
            <input type="text" name="id_admin" value="{{auth('admin')->user()->id_admin}}">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ isset($review_edit) ? $review_edit->titulo : old('titulo') }}" required>
            </div>

            <div class="form-group">
                <label for="titulo2">Título 2:</label>
                <input type="text" name="titulo2" id="titulo2" class="form-control" value="{{ isset($review_edit) ? $review_edit->titulo2 : old('titulo2') }}" required>
            </div>

            <div class="form-group">
                <label for="imagen">URL de la imagen:</label>
                <input type="text" name="imagen" id="imagen" class="form-control" value="{{ isset($review_edit) ? $review_edit->imagen : old('imagen') }}" required>
            </div>

            <div class="form-group">
                <label for="sinopsis">Sinopsis:</label>
                <textarea name="sinopsis" id="sinopsis" class="form-control" rows="3" required>{{ isset($review_edit) ? $review_edit->sinopsis : old('sinopsis') }}</textarea>
            </div>

            <div class="form-group">
                <label for="contenido">Contenido:</label>
                <textarea name="contenido" id="contenido" class="form-control" rows="5" required>{{ isset($review_edit) ? $review_edit->contenido : old('contenido') }}</textarea>
            </div>
            {{-- aqui se muestran y selecciona una etiqueta --}}
            <div class="form-group">
                <label for="contenido">Tags:</label>
                <select class="form-control" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->name_tag }}" @if (isset($reviewTags) && $reviewTags->contains('id_tag', $tag->id_tag)) selected @endif>
                            {{ $tag->name_tag }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- se muestran y selecciona una calificacion --}}
            <div class="form-group">
                <label for="grade">Calificación Maestra:</label>
                <select name="grade" id="grade" class="form-control">
                    <option value="">Selecciona una calificación</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->letter }}"
                            @if (isset($reviewGrades) && $reviewGrades->contains('id_grade', $grade->id_grade))
                                selected
                            @endif
                        >
                            {{ $grade->letter }} - {{ $grade->value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($review_edit) ? 'Actualizar' : 'Crear' }}</button>
        </form>
    </div>

@endsection
