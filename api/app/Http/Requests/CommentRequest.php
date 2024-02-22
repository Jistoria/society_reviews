<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'review_id' => 'required|exists:reviews,review_id',
            'content' => 'required|string',
            'com_comment_id' => 'nullable|exists:comments,comment_id'
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El ID del usuario no existe en la tabla de usuarios.',

            'review_id.required' => 'El ID de la revisión es obligatorio.',
            'review_id.exists' => 'El ID de la revisión no existe en la tabla de revisiones.',

            'content.required' => 'El contenido es obligatorio.',
            'content.string' => 'El contenido debe ser una cadena de texto.',

            'com_comment_id.exists' => 'El ID del comentario no existe en la tabla de comentarios.'
        ];
    }
}
