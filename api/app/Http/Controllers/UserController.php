<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function userRegister(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'color' => 'required',
            'password' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario
        $new_user = new User;
        $new_user->name = $request->input('name');
        $new_user->email = $request->input('email');
        $new_user->password = $request->input('password');
        $new_user->save();
          // Enviar correo electrónico de verificación
        $new_user->sendEmailVerificationNotification();
        // Puedes autenticar al usuario automáticamente si lo deseas
        // auth()->login($new_user);

        // Redireccionar a la página de inicio o a donde desees después de registrar al usuario
        return response()->json(['success' => true, 'message' => 'usuario creado exitosamente'], Response::HTTP_CREATED);
    }
}
