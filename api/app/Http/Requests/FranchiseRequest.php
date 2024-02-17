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
            'image_url' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'original_work' => 'nullable|string|max:255',
            'first_release' => 'nullable|date',
            'end_release' => 'nullable|date',
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
            'title.required'=>'El titulo es obligatorio',
            'title.max' => 'Es demasiado largo el titulo',
            'description.required' => 'La descripción es obligatoria',
            'animation_studio_latest.max' => 'Es muy largo',
            'publication_year' => 'Tiene que ser una fecha',
            'tag_id.required' => 'Se requiere al menos un tag',
            'tag_id.exists' => 'El tag seleccionado no es válido',
            'end_release.date' => 'Debe ser una fecha',
            'first_release.date' => 'Debe ser una fecha'
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
