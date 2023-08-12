<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
  /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Aquí puedes determinar si el usuario está autorizado para hacer esta solicitud.
        // Por ejemplo, si deseas permitir que solo los usuarios autenticados creen reseñas, puedes devolver true si el usuario está autenticado.
        // Si deseas permitir que todos los usuarios creen reseñas (incluso los no autenticados), puedes devolver true en cualquier caso.

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required|unique:reviews',
            'titulo2' => 'required|unique:reviews',
            'imagen' => 'required',
            'sinopsis' => 'required',
            'contenido' => 'required',
            'slug' => 'unique:reviews',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.unique' => 'El título ya está en uso.',
            'titulo2.required' => 'El campo título2 es obligatorio.',
            'titulo2.unique' => 'El título2 ya está en uso.',
            'imagen.required' => 'El campo imagen es obligatorio.',
            'sinopsis.required' => 'El campo sinopsis es obligatorio.',
            'contenido.required' => 'El campo contenido es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
        ];
    }
}
