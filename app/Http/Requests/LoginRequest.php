<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
              //vamo a pedir correctamente los datos
              'name',
              'password',
        ];
    }

      public function getCredentials(){
        return [
        'name' => $this->input('name'),
        'password' => $this->input('password'),
    ];
    }
}
