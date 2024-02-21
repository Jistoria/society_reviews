<?php

namespace App\Http\Requests;

use App\Rules\AfterOrEqualFranchiseFirstRelease;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'franchise_id' => 'required|exists:franchises,franchise_id',
            'content_type_id' => 'required|exists:content_types,content_type_id',
            'user_id' => 'required|exists:users,id',
            'title_alternative' => 'required|string|unique:reviews,title_alternative',
            'description_alternative' => 'nullable|string',
            'data' => 'required|string',
            'rating_main' => 'required|numeric|min:0|max:10',
            'spoiler_content' => 'nullable|string',
            'release_year' => ['required', 'date', new AfterOrEqualFranchiseFirstRelease],
            'release_year_end' => 'required|date|after_or_equal:release_year',
            'quantity_episode' => 'nullable|integer|min:0',
            'duration_time' => 'nullable|date_format:H:i',
            'published' => 'boolean',
        ];
    }
    public function messages()
{
    return [
        'franchise_id.required' => 'El ID de la franquicia es obligatorio.',
        'franchise_id.exists' => 'El ID de la franquicia proporcionado no existe en la tabla de franquicias.',
        'content_type_id.required' => 'El ID del tipo de contenido es obligatorio.',
        'content_type_id.exists' => 'El ID del tipo de contenido proporcionado no existe en la tabla de tipos de contenido.',
        'user_id.required' => 'El ID del usuario es obligatorio.',
        'user_id.exists' => 'El ID del usuario proporcionado no existe en la tabla de usuarios.',
        'title_alternative.unique' => 'El título alternativo proporcionado ya está en uso en otra reseña.',
        'data.required' => 'Los datos son obligatorios.',
        'data.string' => 'Los datos deben ser una cadena de texto.',
        'rating_main.required' => 'El campo de calificación principal es obligatorio.',
        'rating_main.numeric' => 'La calificación principal debe ser un valor numérico.',
        'rating_main.min' => 'La calificación principal debe ser como mínimo :min.',
        'rating_main.max' => 'La calificación principal debe ser como máximo :max.',
        'release_year.required' => 'El año de lanzamiento es obligatorio.',
        'release_year.date' => 'El año de lanzamiento debe ser una fecha válida.',
        'release_year_end.required' => 'El año de finalización es obligatorio.',
        'release_year_end.date' => 'El año de finalización debe ser una fecha válida.',
        'release_year_end.after_or_equal' => 'El año de finalización debe ser igual o posterior al año de lanzamiento.',
        'quantity_episode.integer' => 'La cantidad de episodios debe ser un valor entero.',
        'quantity_episode.min' => 'La cantidad de episodios debe ser como mínimo :min.',
        'duration_time.date_format' => 'El formato de la duración del tiempo debe ser H:i.',
        'published.boolean' => 'El campo publicado debe ser un valor booleano.',
    ];
}
}
