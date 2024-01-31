<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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

    public function userLogin (Request $request){
        // Validación básica de datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Obtener el usuario autenticado
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);

        // Obtener el número de notificaciones del usuario
        $notificationsCount = $user->unreadNotifications->count();
        $user = [
            'name'=> $user->name,
            'email'=> $user->email,
        ];
        // Retornar una respuesta JSON con éxito y el usuario
        // return response(['token'=>$token], Response::HTTP_OK)->withCookie(($cookie));
        return response(['token'=>$token, 'user'=> $user, 'countN'=>$notificationsCount], Response::HTTP_OK)->withCookie(($cookie));
        } else {
            // La autenticación ha fallado
            return response(['success'=>false, 'message'=>'Credenciales invalidas'], Response::HTTP_UNAUTHORIZED);
        }
    }
    public function logout ()
    {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget('cookie_token');
        return response(['message' => 'Cerró Sesión'], Response::HTTP_OK)->withCookie($cookie);
    }
}
