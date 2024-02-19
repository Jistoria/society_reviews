<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FranchiseRequest extends FormRequest
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
    public function rules()
    {
         // Reglas para todos los valores excepto tag_id
        $rulesWithoutTagId = [
            'title' => 'required|string|max:255|unique:franchises',
            'description' => 'required|string',
            'animation_studio_latest' => 'nullable|string|max:255',
            'image_url' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'original_work' => 'required|string|max:255',
            'first_release' => 'required|date',
            'end_release' => 'required|date',
        ];

        // Reglas solo para tag_id
        $rulesOnlyTagId = [
            'tag_id' => 'required|array|exists:tags,tag_id',
        ];

        return $this->isMethod('post') ? $rulesWithoutTagId + $rulesOnlyTagId : $rulesWithoutTagId;
    }

    public function messages()
    {
        return [
                'title.required' => 'El título es obligatorio.',
                'title.string' => 'El título debe ser una cadena de texto.',
                'title.max' => 'El título no puede tener más de 255 caracteres.',
                'title.unique' => 'El título ya está en uso por otra franquicia.',
                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.',
                'animation_studio_latest.string' => 'El estudio de animación más reciente debe ser una cadena de texto.',
                'animation_studio_latest.max' => 'El estudio de animación más reciente no puede tener más de 255 caracteres.',
                'image_url.required' => 'La URL de la imagen es obligatoria.',
                'image_url.string' => 'La URL de la imagen debe ser una cadena de texto.',
                'image_url.max' => 'La URL de la imagen no puede tener más de 255 caracteres.',
                'author.required' => 'El autor es obligatorio.',
                'author.string' => 'El autor debe ser una cadena de texto.',
                'author.max' => 'El autor no puede tener más de 255 caracteres.',
                'original_work.required' => 'La obra original es obligatoria.',
                'original_work.string' => 'La obra original debe ser una cadena de texto.',
                'original_work.max' => 'La obra original no puede tener más de 255 caracteres.',
                'first_release.required' => 'La fecha de primera publicación es obligatoria.',
                'first_release.date' => 'La fecha de primera publicación debe ser una fecha válida.',
                'end_release.required' => 'La fecha de finalización es obligatoria.',
                'end_release.date' => 'La fecha de finalización debe ser una fecha válida.',
                'tag_id.required' => 'Se requiere al menos un tag',
                'tag_id.exists' => 'El tag seleccionado no es válido',
        ];
    }

    // public function dataFranchise()
    // {
    //     return $this->only('title', 'description', 'animation_studio_latest','publication_year');
    // }

    // public function dataTags()
    // {
    //     return $this->only('tag_id');
    // }
}
