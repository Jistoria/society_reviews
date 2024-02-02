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
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'animation_studio_latest' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'original_work' => 'nullable|string|max:255',
            'publication_year' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'El titulo es obligatorio',
            'title.max' => 'Es demasiado largo el titulo',
            'description.required' => 'La descripción es obligatoria',
            'animation_studio_latest.max' => 'Es muy largo',
            'publication_year' => 'Tiene que ser una fecha'
        ];
    }
}
